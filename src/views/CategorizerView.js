
PlantAhead.namespace(
    'PlantAhead.Views.CategorizerView',
    Backbone.View.extend({
        //className: 'active',
        //tagName:"ul",
        initialize: function (options) {
            this.options = options || {};

            this.model = this.options.model;
            this.listenTo(this.model, "change:selectedCategory", this.render);

            this.collection = this.options.collection;

            this.parent = this.options.parentView;

            this.options.badgeFields = _.filter(PlantAhead.InitData.tableMeta.fieldsMeta, function(field){
                return typeof field.comment.badgeColor != 'undefined'
            });
            _.each(this.options.badgeFields, function(badge){
                if(badge.comment.dependsOn)
                    badge.visible = false;
            });
        },
        convertCamelCase: function(string){
            var words = string.match(/[A-Za-z][a-z]*/g);
            return words.map(this.capitalize).join(" ");
        },
        capitalize: function(word){
            return word.charAt(0).toUpperCase() + word.substring(1);
        },
        createSection: function($el, category, badge, firstRun){
            var self = this;
            console.log('createSection');
            self.uxUtils = new PlantAhead.Utils.uxUtils();
            $el.empty();
            var dbName = category.slice(0, -2);
            var lists = _.indexBy(PlantAhead.InitData.fkCollections[dbName], dbName+"Name");
            self.section = {};
            //set category badge color, set to default to gray if none selected
            var categoryBadgeColor = badge ? badge.badgeColor : "grey";
            var categoryBadgeIcon = badge ? badge.badgeIcon : "not_interested";
            var collection = this.collection.groupBy(category);
            var fkCollection = new Backbone.Collection(PlantAhead.InitData.fkCollections[category.slice(0,-2)]);
            var o = {};
            _.each(fkCollection.models, function(m){ o[m.id] = m.get(category.slice(0,-2)+"Name"); });
            var temp = {};
            _.each(collection, function(value, key) {
                key = o[key] || key;
                temp[key] = value;
            });
            var nameOrder = _.union(Object.keys(lists), Object.keys(temp) ).sort();
            self.nameOrder = nameOrder;
            //var nameOrder = this.sortKeys(temp).sort();
            _.each(nameOrder, function(o){
                var cat = fkCollection.find(function(m){return m.get(category.slice(0,-2)+"Name") == o;})
                var categoryID = typeof cat != 'undefined' ? cat.get('id') : null;
                var db = category;
                if(category.indexOf('ID') > -1) db = category.slice(0,-2);
                var categoryName = o != 'null' ? o : self.convertCamelCase(category.slice(0,-2))+" Not Set";
                var models = _.sortBy(temp[o], function(m){ return m.timestamp});
                var completedModels = _.filter(models, function(m){ return m.get('completed') == 1 });
                var incompleteModels = _.filter(models, function(m){ return m.get('completed') != 1 });
                var isEmpty = (incompleteModels.length == 0) ? "empty-section":'';
                var section = new PlantAhead.Views.CategorizerSectionView({
                    title: categoryName,
                    categoryID: categoryID,
                    db: db,
                    incompleteModels: incompleteModels,
                    completedModels: completedModels,
                    badgeFields: self.options.badgeFields,
                    sortModel: self.options.sortModel,
                    model: new PlantAhead.Models.ReifyModel({'selectedCategoryName': category, 'selectedCategoryID': categoryID}),
                    collection: self.uxUtils.mapFkNames(new Backbone.Collection(models)),
                    categoryBadgeColor: categoryBadgeColor,
                    categoryBadgeIcon: categoryBadgeIcon,
                    name: o.toLowerCase().replace(' ','-'),
                    newModel: new Backbone.Model,
                    parentView: self,
                    firstRun: firstRun
                });

                var firstLevelBadge = _.find(self.options.badgeFields, function(badge){ return badge.comment.dependsOn == self.options.model.attributes.selectedCategory });
                if(firstLevelBadge) firstLevelBadge.visible = true;


                //hide section if no incomplete tasks
                $el.append(section.render().$el.addClass(isEmpty));

                self.section[categoryID] = section;
            });
        },
        createCategorizerItem: function(model, section){
            var categorizerItem = new PlantAhead.Views.CategorizerItemView({
                parentView: this,
                model: model,
                badgeFields: this.options.badgeFields
            });
            section.$el.append(categorizerItem.render().$el);

        },
        render: function() {
            var self = this;
            var category = this.model.get('selectedCategory');
            //var reifiedBadge = this.options.sortModel.decode(this.options.sortURL).reifierType;
            //var reifiedBadgeField = _.find(this.options.badgeFields, function(o){ return o.name == reifiedBadge  }, reifiedBadge); //var badgeInfo = typeof _.find(self.options.badgeFields, function(e){return e.name == category}).comment.badgeColor != 'undefined' ? _.find(self.options.badgeFields, function(e){return e.name == category}).comment : null;
            //this.createSection(this.$el, category, badgeInfo);

            var incompleteModels = _.filter(this.collection.models, function(m){
                return m.get('completed') != 1;
            });
            var completedModels = _.filter(this.collection.models, function(m){
                return m.get('completed') == 1;
            });

            var section = new PlantAhead.Views.CategorizerSectionView({
                title: this.model.attributes.tableName,
                //categoryID: categoryID,
                //db: db,
                incompleteModels: incompleteModels,
                completedModels: completedModels,
                badgeFields: self.options.badgeFields,
                sortModel: self.options.sortModel,
                model: new PlantAhead.Models.ReifyModel(),
                collection: this.collection,
                //categoryBadgeColor: categoryBadgeColor,
                //categoryBadgeIcon: categoryBadgeIcon,
                //name: o.toLowerCase().replace(' ','-'),
                newModel: new PlantAhead.Models.ReifyModel(),
                parentView: self
            });

            //self.$el.append(newSection.render().$el);
            self.$el.append(section.render('active', true).$el);


            return this;
        },

        sortKeys: function(obj)
        {
            var keys = [];

            for(var key in obj)
            {
                if(obj.hasOwnProperty(key))
                {
                    keys.push(key);
                }
            }

            return keys;
        },
        retrieveSortLevel: function(){
            if(this.parent.options.parentView.options.categoryID){
                this.parent = this.parent.options.parentView;
                this.retrieveSortLevel();
            }
            else{
                return this.parent;
            }
        },
        makeBadge: function(extraClass, text, iconName, field, badgeFunction, parentView){
            if(typeof field.visible == 'undefined' || field.visible){
                if (String(text).indexOf('null') != -1) text = "";
                var badge = new PlantAhead.Views.Badge({
                    className: "badge "+extraClass,
                    text: text,
                    iconName: iconName,
                    field: field,
                    badgeFunction: badgeFunction,
                    parentView: parentView
                });
                return badge.render().$el;
            }
        }

    })
);