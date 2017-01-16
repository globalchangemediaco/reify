PlantAhead.namespace(
    'PlantAhead.Models.ReifyModel',
    Backbone.Model.extend({
        toJSON: function(options) {
            this.unset('uid');
            return _.omit(this.attributes, function(val, key){
                return key.indexOf("Name") != -1;
            });
        }

    })
);
