
PlantAhead.namespace(
    'PlantAhead.Views.CategorizerSectionView',
        PlantAhead.Views.CategorizerView.extend({
        tagName: "ul",
        className: "collapsible categorizerSection",
        events: {
            "click .collapsible-header": "collapsibleClick"
        },
        template: _.template($('#categorizerSection_template').html()),

        //pass options object through initialization call
        initialize: function(options) {
            this.options = options || {};
            if(this.options.parentView.model)
                this.options.badgeFields = _.filter(this.options.badgeFields, function(b){  return b.name != this.options.parentView.model.get('selectedCategory')}, this);
            _.bindAll(this, 'collapsibleClick');
            this.firstRun = true;
        },
        sectionRender: function(active){
            var self = this;
            var completedIsActive = $(this.$el.find('.complete-items-list')[0]).hasClass('active') ? 'active':'';

            if(this.options.completedModels == null) this.options.completedModels = [];
            this.$el.html(this.template({
                active: active,
                title: this.options.title,
                completed: this.options.completedModels.length,
                incomplete: this.options.incompleteModels.length,
                gridLinkUri: this.options.gridLinkUri,
                badgeColor: this.options.categoryBadgeColor,
                badgeIcon: this.options.categoryBadgeIcon,
                name: this.options.name
            }));
            this.$el.data({collapsible:"expandable"});

            this.$body = this.$('.collapsible-body');

            this.$body.append('<ul class="collapsible items-list" data-collapsible="expandable"><span class="items"></span></ul>');
            this.$items = this.$('.items');
            this.$itemsList = this.$('.items-list');


            var addCategorizerItem = new PlantAhead.Views.CategorizerItemView({
                title: 'Add New',
                badgeColor: 'green',
                parentView: this,
                model: new PlantAhead.Models.ReifyModel,
                type: 'item',
                badgeFields: this.options.badgeFields
            });
            self.$items.append(addCategorizerItem.render().$el);
            self.addCategorizerItem = addCategorizerItem;


            //sort by priority
            this.options.incompleteModels = _.sortBy(this.options.incompleteModels, function(m){return m.get('taskPriorityLevelID')*-1});
            //incomplete items
            _.each(this.options.incompleteModels, function(model) {
                var categorizerItem = new PlantAhead.Views.CategorizerItemView({
                    parentView: this,
                    model: model,
                    badgeFields: this.options.badgeFields
                });
                self.$items.append(categorizerItem.render().$el);
            }, this);


            //this.$items.append('<li class="collapsible-header valign-wrapper add-new"><div class="collapsible-header section-header"><span class="badge category-badge green"><i class="material-icons badge-icon">add</i></span><strong>Add New</strong></div></li>');
            this.$itemsList.append('<ul class="collapsible completed" data-collapsible="expandable"><li class="complete-items-list '+completedIsActive+'"><div class="complete-items-list collapsible-header section-header '+completedIsActive+'"><strong>Completed</strong></div><div class="completed-items collapsible-body" ></div></li></ul>');
            this.$completedItems = this.$('.completed-items');

            _.each(this.options.completedModels, function(model) {
                var categorizerItem = new PlantAhead.Views.CategorizerItemView({
                    parentView: this,
                    model: model
                });
                self.$completedItems.append(categorizerItem.render().$el);
            }, this);

            this.$('.completed').collapsible();
            this.$items.collapsible();
            this.$el.collapsible();
        },

        render: function (active, firstRun) {
            firstRun = (typeof firstRun != "undefined") ? firstRun : false;
            if(this.options.categorizedBy){
                this.createSection(this.$items, this.options.categorizedBy, this.options.categorizedBadge.comment, firstRun);
            }
            else{
                this.sectionRender(active);
                this.appendCategorizerBadges();
            }
            return this;
        },
        appendCategorizerBadges: function(section){
            var self = this;
            //self.section[categoryID] = section;
            $(this.el.lastElementChild).find('.collapsible-body').first().prepend('<div class="badge-container-body sort-badges"></div>');
            _.each(this.options.badgeFields, function(field){
                if (field.type == 'select2') {
                    var fieldName = field.name.indexOf('ID') != -1 ? field.name.slice(0, -2) + "Name" : field.name;
                    $(this.el.lastElementChild).find('.sort-badges').prepend(self.makeBadge(field.comment.badgeColor + ' valign', "", field.comment.badgeIcon, field, 'sortable', this));
                }
            }, this);
            $(this.el.lastElementChild).find('.sort-badges').append(self.makeBadge('valign', "", 'visibility', {}, 'hide-reveal', this));

        },
        openInGrid : function(e){
            e.stopPropagation();
            window.location.href = this.options.gridLinkUri;
        },
        getCurrentNestLevel : function(n, parentView){
            n = (typeof n != "undefined") ? n : 0;

            if(parentView.options.categoryID){
                parentView = parentView.options.parentView;
                n++;
                this.getCurrentNestLevel(n, parentView);
            } else {
                return n;
            }
        },
        getParentReifier : function(){
            return this.options.parentView.model.get('reifier');        
        },

        collapsibleClick : function(e){
            e.stopPropagation();
            //create object representing current list that was selected
            var openID = this.model.get('selectedCategoryID');

            if (!$(e.currentTarget).hasClass("active")){
                this.options.sortModel.setOpenList(openID, this.getCurrentNestLevel( 0, this ), this.getParentReifier());
            } else {
                this.options.sortModel.unsetOpenList(openID, this.getCurrentNestLevel( 0, this ), this.getParentReifier());
            }
        }
    })
);