/**
 * Created by dev on 7/8/16.
 */
PlantAhead.namespace(
    'PlantAhead.Views.Badge',
    Backbone.View.extend({
        tagName: "a",
        className: "badge",
        template: _.template($('#badge_template').html()),
        events: {
            "click .editable":"editClick",
            "click .sortable":"sortClick",
            "click .hide-reveal": "hideReveal"
        },
        initialize: function(options) {
            this.options = options || {};
            this.parent = this.options.parentView;
        },
        render: function () {
            this.$el.html(this.template({
                text: this.options.text,
                badgeFunction: this.options.badgeFunction,
                iconName: this.options.iconName
            }));
            return this;
        },
        hideReveal: function(e){
            console.log('now hidereveal');
            if($(this.options.parentView.$el).find('.empty-section').hasClass('reveal')){
                this.$el.removeClass('selected-category');
                $($.find('.empty-section')).removeClass('reveal');
            }
            else{
                this.$el.addClass('selected-category');
                $($.find('.empty-section')).addClass('reveal');
            }
        },
        editClick: function(e){
            console.log('edit badge');
            switch(this.options.field.type){
                case "date":
                    console.log('edit date badge');
                    break;
                case "select2":
                    console.log('edit select2 badge');
                    var savedEl = this.$el.html();
                    //var select2 = this.options.parentView.editUtils.makeSelect2('edit-select2-badge', this.options.parentView.uxUtils.getOptionsHTML(this.options.field), this);
                    var select2 = new PlantAhead.Views.Select2({
                        savedEl: savedEl,
                        className: 'edit-select2-badge',
                        optionsHTML: this.options.parentView.uxUtils.getOptionsHTML(this.options.field, this.options.parentView.model.get(this.options.field.name), ' '),
                        parentView: this,
                        onChange: function(e){
                            console.log('editUtils change');
                            var self = this;
                            this.val = e.val;

                            if (typeof this.parentView.options.parentView.model.collection == 'undefined') {
                                var parent = this.parentView.retrieveSortLevel();
                                parent.options.parentView.collection.add(this.parentView.options.parentView.model);
                            }

                            this.parentView.options.parentView.model.save(this.parentView.options.field.name, this.val, {success: $.proxy(function(e){
                                console.log('saving');
                                var attr = (this.parentView.options.field.name).slice(0,-2);
                                var found = _.filter(PlantAhead.InitData.fkCollections[attr], function(o){
                                    return o.id == this.val
                                }, this);
                                e.set(attr+"Name", found[0][attr+"Name"]);
                                //this.parentView.options.parentView.render(true);
                                //new value
                                var val = '<span class="badge-text">'+found[0][attr+"Name"]+'</span>';
                                var icon = '<i class="material-icons badge-icon editable">'+this.parentView.options.iconName+'</i>';
                                //reset the hmtl
                                var newHTML = this.savedEl.replace(/<i class="material-icons badge-icon editable">.*<\/i>/, icon);
                                newHTML = newHTML.replace(/<span class="badge-text">.*<\/span>/, val);
                                this.parentView.$el.html(newHTML);
                            }, this)});



                            //remap with the FK names
                            //this.parentView.options.parentView.model.attributes = this.parentView.options.parentView.uxUtils.mapFkNames(this.parentView.options.parentView.model,null,true);

                        }
                    });
                    this.$el.html(select2.render().$el);
                    $(this.$el).find('select').select2();
                    //$('.edit-select2-badge').select2();
                    break;
                case "number":
                    console.log('edit number badge');
                    break;
                case "timestamp":
                    console.log('edit timestamp badge');
                    break;
            }
        },
        sortClick: function(e){
            
            console.log('sort badge');
            var self = this;

            //highlight current category badge and de-highlight any others
            if( !$(e.currentTarget).parent().hasClass('selected-category')) {
                var selected = false;
                $(e.currentTarget).parent().addClass('selected-category');
            }
            else {
                var selected = true;
                $(e.currentTarget).parent().removeClass('selected-category');
            }
            
            if (!selected){
                this.parent.model.set('reifier',this.options.field.name);
            }

            $(e.currentTarget).parent().parent().children().not($(e.currentTarget).parent()).removeClass('selected-category');

            //hide add new and completed for parent section view to eliminate confusion
            this.options.parentView.$('ul.add-new-task,ul.completed').hide();

            this.index = -1;
            this.retrieveSortLevel();

            _.each(this.parent.options.badgeFields, function(badge){
                if(badge.comment.dependsOn && _.indexOf(this.parent.options.sortModel.get('sortFields'), badge.comment.dependsOn) < 0)
                    badge.visible = false;
            }, this);
            var dependencyBadge = _.find(this.parent.options.badgeFields, function(badge){
                return badge.comment.dependsOn == self.options.field.name;
            });
            if(dependencyBadge) dependencyBadge.visible = true;


            //restore the badge if there already was one being used to categorize (this maintains one-to-one relationship of badge to categorization level)
            if(this.options.parentView.options.categorizedBadge)
                this.options.parentView.options.badgeFields.push(this.options.parentView.options.categorizedBadge);

            //store state of categorized badge
            this.options.parentView.options.categorizedBadge = _.find(this.options.parentView.options.badgeFields, function(b){ return b.name == this.options.field.name}, this);
                //remove currently active badges in this sort stack
            if( !selected) {
                this.options.parentView.options.badgeFields = _.filter(this.options.parentView.options.badgeFields, function (b) {
                    return b.name != this.options.field.name
                }, this);
            }
                //set value of model for new item
                //this.options.parentView.addCategorizerItem.model.set(this.options.parentView.options.categorizedBadge.name, this.options.parentView.options.categoryID);

            var sortModel = this.parent.options.sortModel;

            if (!selected) {
                sortModel.setReifierType(this.options.field.name, this.parent.getCurrentNestLevel(0,this.options.parentView), this.parent.getParentReifier());
            } else {
                sortModel.unsetReifierType(this.options.field.name, this.parent.getCurrentNestLevel(0,this.options.parentView), this.parent.getParentReifier());
            }

                // if( this.parent.options.sortModel )
                // {
                //     var sortFields = this.parent.options.sortModel.get( 'sortFields' ).slice( 0, this.index );
                //
                //     sortFields.push( self.options.field.name );
                //     this.parent.options.sortModel.attributes.sortFields = sortFields;
                //     //this.parent.options.sortModel.set('sortFields',sortFields);
                //
                //     this.options.parentView.options.sortModel.trigger( "change:sortFields", this, sortModel );
                // }



                this.parent.options.newModel.set(this.options.parentView.options.db+"ID", this.options.parentView.options.categoryID);

            if( !selected) {
                this.options.parentView.options.categorizedBy = this.options.field.name;
                this.options.parentView.render();

            }
            else {
                this.options.parentView.options.categorizedBy = null;
                this.options.parentView.render('active');

            }

        },
        onClick : function (e) {
            if(this.options.badgeFunction == 'editable'){

            }
            else if(this.options.badgeFunction == 'sortable'){

            }
            else{
                this.options.onClick(e, this.options.parentView);
            }

        },
        retrieveSortLevel: function(n){
            this.index++;
            if(this.parent.options.parentView.options.categoryID){
                this.parent = this.parent.options.parentView;
                this.retrieveSortLevel();
            }
            else{
                return this.parent;
            }
        }
    })
);
