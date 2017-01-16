/**
 * Created by caseri on 10/18/16.
 */
PlantAhead.namespace(
    'PlantAhead.Utils.uxUtils',
    function uxUtils() {
        this.mapFkNames = function (collectionJSON, reset, isModel) {
            if(isModel) collectionJSON = new Backbone.Collection(collectionJSON);
            if(collectionJSON.models == '') return new Backbone.Collection();

            //handle arrays
            if(_.isArray(collectionJSON)){
                collectionJSON = new Backbone.Collection(collectionJSON);
                var array = true;
            }

            //find FK fields in collection
            var fkFields = _.filter(Object.keys(collectionJSON.models[0].attributes), function (k){
                return k.indexOf("ID") != -1
            });

            var colls = [];

            //build collections from fk fields
            _.each(fkFields, function(field){
                var name = field.slice(0,-2);
                colls[name] = ( new Backbone.Collection(PlantAhead.InitData.fkCollections[name]));
            });

            var uid = 1;
            var mappedColl = _.map(collectionJSON.models, function(m) {
                var mappedObj = {};

                _.each(m.attributes, function(val, key){

                    if (key.indexOf("ID") != -1) {
                        mappedObj[key] = val;
                        var table = key.slice(0,-2);
                        key = table+"Name";
                        if (val) {
                            val = colls[table].get(val).get(key);
                        }
                    }
                    mappedObj[key] = val;
                });
                mappedObj["uid"] = uid;
                uid++;
                return mappedObj;
            });

            //create a collection but omit the mapped attributes from saving
            var MappedCollection = Backbone.Collection.extend({
                model: Backbone.Model.extend({
                    toJSON: function(options){
                        var attrsToOmit = _.filter(Object.keys(this.attributes), function(n){return n.indexOf("Name") != -1});
                        this.attributes = _.omit(this.attributes, attrsToOmit);
                        this.attributes = _.omit(this.attributes, "uid");
                        return this.attributes;
                    }
                })
            });

            if(reset){
                collectionJSON.reset(mappedColl);
            }

            if(array){
                return mappedColl;
            }
            else if(isModel){
                return mappedColl;
            }
            else{
                return new MappedCollection(mappedColl);
            }
        };

        this.getOptionsHTML = function(field, currentVal, starterVal){
            if(!starterVal) starterVal = 'Choose an option';
            this.currentVal = currentVal;
            var selected='';
            var dbName = field.name.slice(0, -2);
            var filteredFKCollection = PlantAhead.InitData.fkCollections[dbName];
            filteredFKCollection = this.mapFkNames(filteredFKCollection);
            var optionValues = {
                values: _.sortBy(_.map(filteredFKCollection, function (o) {
                    return [o[dbName + "Name"], o["id"]];
                }), function (val) {
                    return val[0]
                })
            };
            var optionsHTML = '<option selected disabled>'+starterVal+'</option>';
            _.each(optionValues.values, function(o){
                selected = '';
                if(o[1] == this.currentVal) selected="selected='selected'";
                optionsHTML = optionsHTML + "<option value='" + o[1] + "' "+selected+">" + o[0] + "</option>";
            }, this);
            return optionsHTML;
        };

        this.mapFKNamesInModel = function(model) {
            var fkFields = _.filter(Object.keys(model.attributes), function (k){
                return k.indexOf("ID") != -1
            });

            var colls = [];

            //build collections from fk fields
            _.each(fkFields, function(field){
                var name = field.slice(0,-2);
                colls[name] = ( new Backbone.Collection(PlantAhead.InitData.fkCollections[name]));
            });

            var mappedObj = {};

            _.each(model.attributes, function(val, key){

                if (key.indexOf("ID") != -1) {
                    mappedObj[key] = val;
                    var table = key.slice(0,-2);
                    key = table+"Name";
                    if (val) {
                        val = colls[table].get(val).get(key);
                    }
                }
                mappedObj[key] = val;
            });

            return new Backbone.Model(mappedObj);
        }
    }


);


