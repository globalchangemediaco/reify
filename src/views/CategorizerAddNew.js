
PlantAhead.namespace(
    'PlantAhead.Views.CategorizerAddNew',
        PlantAhead.Views.CategorizerItemView.extend({
        template1: _.template($('#categorizerItem_template').html()),
        //template2: _.template($('#categorizerAddNewEdit_template').html()),
        events: {
            //"click .editMe": "addNew",
            //"click .saveMe": "saveNew",
            "click .card-title" : "editDescription",
            "blur .card-title" : "saveNew",
            "change .card-title": "setValue"
        },
        className: "itemView add-new-task",
        initialize: function(options) {
            this.options = options || {};
            this.template = this.template1;
            this.type = this.options.type;
            this.options.id = this.options.parentView.options.db;
            this.val = '';
            this.model = new Backbone.Model;
            this.uxUtils = new PlantAhead.Utils.uxUtils;
        },
        editDescription: function (e) {
            console.log('clicked');
            if ($(e.currentTarget).parent().hasClass('active')) {
                console.log('isactive');
                e.stopPropagation();
                $(e.currentTarget).attr('contenteditable',true);
                $(e.currentTarget).focus();
            }
        },
        render: function () {
            var self = this;
            this.$el.html(this.template({
                title: this.options.title,
                badgeColor: this.options.badgeColor,
                id: this.options.id,
                checked: '',
                task: ''
            }));

            this.$el.children('.collapsible-header').append('<div class="badge-container"></div>');
            this.$headerBadge = this.$el.children('.collapsible-header').children('.badge-container');

            this.$el.children('.collapsible-body').append('<div class="badge-container-body"></div>');
            this.$bodyBadge = this.$el.children('.collapsible-body').children('.badge-container-body');

            _.each(this.options.badgeFields, function(field){
                //var fieldName = field.name.indexOf('ID') != -1 ? field.name.slice(0, -2) : field.name;
                //var text =  _.filter(PlantAhead.InitData.fkCollections[fieldName], function(i){ return i.id == self.options.model.get(fieldName+'ID') })[0][fieldName+"Name"];
                if (field.name == 'taskPriorityLevelID')
                    self.$headerBadge.append(self.makeBadge(field.comment.badgeColor+' valign priority-badge','',field.comment.badgeIcon, field, 'editable', self));
                else {
                    var fieldName = field.name.indexOf('ID') != -1 ? field.name.slice(0, -2) + "Name" : field.name;
                    //var badgeText = (typeof self.options.model.get(fieldName) == "undefined") ? "" : self.options.model.get(fieldName);
                    self.$bodyBadge.append(self.makeBadge(field.comment.badgeColor + ' valign', "", field.comment.badgeIcon, field, 'editable', self));
                }
            });

            this.$el.collapsible();
            return this;
        },
        addNew: function(e){
            this.template = this.template2;
            this.options.badgeColor = 'purple';
            this.render();
        },
        saveNew: function(e){
            switch(this.type){
                case "item":
                    console.log("TODO: save new tasklist item");

                    this.parent = this.options.parentView; //initialize parent
                    this.retrieveSortLevel(); //recursively find top parent of current sort stack
                    var newModel = this.parent.options.newModel.clone(); //ready model
                    newModel.set('task', this.val);
                    newModel.set(this.options.parentView.options.db+"ID", this.options.parentView.options.categoryID);
                    //newModel.set(this.parent.options.db+"ID", this.parent.options.categoryID);


                    //this.model.set(this.options.parentView.options.db+"ID",this.options.parentView.options.categoryID);
                    newModel.set('taskPriorityLevelID',1);
                    this.model = this.parent.options.parentView.collection.create(newModel.attributes, {wait:true});
                    this.options.parentView.options.incompleteModels.push(this.uxUtils.mapFKNamesInModel(this.model));

                    this.options.parentView.render();
                    break;
                case "section":
                    console.log('saving new category section');
                    this.db = this.options.parentView.options.parentView.categorizerModel.attributes.selectedCategory.slice(0, -2);
                    var col = this.db+"Name";
                    this.model.set(col, this.val);
                    //var data = {col: this.val};
                    $.post('/api/'+this.db,JSON.stringify(this.model.attributes) ).success( $.proxy(function(e){
                        var model = new Backbone.Model;
                        model.set(this.db+"Name", this.val);
                        model.set('id',JSON.parse(e ).id);
                        PlantAhead.InitData.fkCollections[this.db].push(model.attributes);
                        this.options.parentView.render();

                        //scroll page to newly added item
                        $('html, body').animate({
                            scrollTop: $('.'+this.val.toLowerCase().replace(' ','-')).offset().top
                        }, 2000);
                    },this));
                    break;
            }


        },
        setValue: function(e){
            this.val = e.target.value;
        }
    })
);