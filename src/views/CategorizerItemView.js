PlantAhead.namespace(
    'PlantAhead.Views.CategorizerItemView',
        PlantAhead.Views.CategorizerView.extend({
        tagName:"li",
        className:"itemView",
        template: _.template($('#categorizerItem_template').html()),
        events: {
            "click .mark-complete" : "markComplete",
            "click .card-title" : "editDescription",
            "blur .card-title" : "editableTextBlurred",
            "click .close-item" : "closeItem"
        },

        markComplete: function(e){
            console.log(e);
            if(e.target.checked){
                this.model.set('completed',1);
                //this.options.parentView.options.completedModels.push(this.model);
                //this.options.parentView.options.completedModels = _.sortBy(this.options.parentView.options.completedModels, function(m){ return m.get('timestamp')});
                //this.options.parentView.options.incompleteModels = _.reject(this.options.parentView.options.incompleteModels, function(m){ return m.get('id') == this.model.get('id') }, this);

            }
            else{
                this.model.set('completed',0);
                //this.options.parentView.options.incompleteModels.push(this.model);
                //this.options.parentView.options.incompleteModels = _.sortBy(this.options.parentView.options.incompleteModels, function(m){ return m.get('timestamp')});
                //this.options.parentView.options.completedModels = _.reject(this.options.parentView.options.completedModels, function(m){ return m.get('id') == this.model.get('id') }, this);
            }

            this.model.save();
            //$actives = $('.active');
            //this.options.parentView.render('active');
            //_.each($actives, function(a){
            //    $(a).addClass('active');
            //});

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

        editableTextBlurred: function(e) {
            if(!this.model.attributes.id){
                debugger;

            }
            else{
                $(e.currentTarget).attr('contenteditable',false);
                if ($(e.currentTarget).html() != this.model.get('task')) {
                    if (typeof this.model.collection == 'undefined') {
                        this.options.parentView.collection.add(this.model);
                    }
                    this.model.save('task', $(e.currentTarget).html())
                }

            }
        },

        closeItem: function(e) {
            //manually collapse item detail view,  TODO implement slideup animation on hide.
            this.options.parentView.$items.children('.active').children('.collapsible-body').hide();
            this.options.parentView.$items.children('.active').find('.collapsible-header').removeClass('active');
            this.options.parentView.$items.children('.active').removeClass('active');
        },

        initialize: function (options) {
            this.options = options || {};
            this.uxUtils = new PlantAhead.Utils.uxUtils;
            _.bindAll(this, "editableTextBlurred");
            _.bindAll(this, "closeItem");

        },
        render: function(remap) {
            var details = '';
            var checked = '';
            //if(remap){
            //    this.model.attributes = this.uxUtils.mapFkNames(this.model, null, true );
            //    this.model.collection = this.uxUtils.mapFkNames(this.model.collection);
            //}
            var self = this;

            var attrs = _.omit(this.options.model.attributes, function(val, key){
                return key.indexOf("ID") != -1;
            });

            _.each(attrs, function(val, attr){
               details += '<div class="chip" style="margin:2px;">'+attr+' : '+val+'</div>';
            });

            if(this.options.model.get('completed') == 1) checked = 'checked';

            this.$el.html(this.template({
                task: this.options.model.get('task'),
                data: this.options.model.attributes,
                id: this.options.model.get('id'),
                checked: checked,
                details: details
            }));

            this.$el.children('.collapsible-header').append('<div class="badge-container"></div>');
            this.$headerBadge = this.$el.children('.collapsible-header').children('.badge-container');

            this.$el.children('.collapsible-body').append('<div class="badge-container-body"></div>');
            this.$bodyBadge = this.$el.children('.collapsible-body').children('.badge-container-body');

            _.each(this.options.badgeFields, function(field){
                //var fieldName = field.name.indexOf('ID') != -1 ? field.name.slice(0, -2) : field.name;
                //var text =  _.filter(PlantAhead.InitData.fkCollections[fieldName], function(i){ return i.id == self.options.model.get(fieldName+'ID') })[0][fieldName+"Name"];
                if (field.name == 'taskPriorityLevelID') {
                    if(typeof self.options.model.get(field.name) == 'undefined'){
                        var text = '';
                    }
                    else{
                        var text = self.options.model.get(field.name);
                    }
                    self.$headerBadge.append(self.makeBadge(field.comment.badgeColor + ' valign priority-badge', "" + text, field.comment.badgeIcon, field, 'editable', self));
                }
                else {
                    var fieldName = field.name.indexOf('ID') != -1 ? field.name.slice(0, -2) + "Name" : field.name;
                    var badgeText = (typeof self.options.model.get(fieldName) == "undefined") ? "" : self.options.model.get(fieldName);
                    self.$bodyBadge.append(self.makeBadge(field.comment.badgeColor + ' valign', "" + badgeText, field.comment.badgeIcon, field, 'editable', self));
                }
            });



            //this.makeBadge('blue valign hide-on-small-only',""+this.options.model.get('userName'),'perm_identity');
            //this.makeBadge('green valign hide-on-small-only',""+moment(this.options.model.get('timestamp')).format('MMM D YYYY'), 'today');
            //this.makeBadge('orange valign hide-on-small-only',""+this.options.model.get('laborEstimate')+" hours", 'query_builder');
            //this.makeBadge('red valign',""+this.options.model.get('taskPriorityLevelID'), 'build');

            $("<div class='close-item'><i class='material-icons'>drag_handle</i></div>").insertAfter(this.$bodyBadge);
            return this;
        }
    })
);