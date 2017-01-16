PlantAhead.namespace(
    'PlantAhead.Models.CategorizerSortModel',
    Backbone.Model.extend({
        
        initialize: function ()
        {
            var self = this;
            this.set('reifierState', {});
            this.get('reifierState')['reifierType'] = {};
            this.get('reifierState')['open'] = [];

            this.on( "change:reifierState", function ( model, options )
            {
                this.updateURL();
            });
        },
        
        setReifierType : function (reifierType, nestLevel, parentReifier) {
            console.log('setReifierType');
            this.get('reifierState')['reifierType'] =  reifierType;
            this.trigger("change:reifierState", this);
        },

        unsetReifierType : function (reifierType, nestLevel, parentReifier) {
            console.log('unsetReifierType');
            this.get('reifierState')['reifierType'] = {};
            this.trigger("change:reifierState", this);
        },

        setOpenList : function ( openID, nestLevel, parentReifier ) {
            console.log('setOpenList');
            this.get('reifierState')['open'].push(openID);
            this.trigger("change:reifierState", this);
        },

        unsetOpenList : function ( openID, nestLevel, parentReifier ) {
            console.log('unsetOpenList');
            this.get('reifierState')['open'] = _.without(this.get('reifierState')['open'], openID );
            this.trigger("change:reifierState", this);
        },

        updateURL : function () {
            var tableName = PlantAhead.InitData.tableMeta.tableName;
            console.log(this.get('reifierState'));
            var newURL = this.encode(this.get('reifierState'));
            window.history.pushState("object or string", "Title", window.location.origin + "/categorizer/"+tableName+"/" + newURL);
        },

        loadFilterFromURL: function (filter) {
            var self = this;
            var filterObjs = this.decode(filter);
            _.each(filterObjs, function(filterObj, columnName){
                if(typeof filterObj == 'object')
                    _.each(filterObj, function (val, filterType) {
                        self.get("filters")[columnName][filterType] = val;
                    });
            });
            this.trigger("change:filters", this);
        },

        /**
         * Encode a [deeply] nested object for use in a url
         * Assumes Array.each is defined
         */
        encode: function(params, prefix) {

            var items = [];

            for(var field in params) {

                var key  = prefix ? prefix + "[" + field + "]" : field;
                var type = typeof params[field];

                switch(type) {

                    case "object":

                        //handle arrays appropriately x[]=1&x[]=3
                        if(params[field].constructor == Array) {
                            _.each(params[field], function(val) {
                                items.push(key + "[]=" + val);
                            }, this);
                        } else {
                            //recusrively construct the sub-object
                            items = items.concat(this.encode(params[field], key));
                        }
                        break;
                    case "function":
                        break;
                    default:
                        items.push(key + "=" + escape(params[field]));
                        break;
                }
            }

            return items.join("&");
        },

        /**
         * Decode a deeply nested Url
         */
        decode: function(params) {

            var obj	  = {};
            var parts = params.split("&");

            _.each(parts,function(kvs) {

                var kvp = kvs.split("=");
                var key = kvp[0];
                var val = unescape(kvp[1]);

                if(/\[\w+\]/.test(key)) {

                    var rgx = /\[(\w+)\]/g;
                    var top = /^([^\[]+)/.exec(key)[0];
                    var sub = rgx.exec(key);

                    if(!obj[top]) {
                        obj[top] = {};
                    }

                    var unroot = function(o) {

                        if(sub == null) {
                            return;
                        }

                        var sub_key = sub[1];

                        sub = rgx.exec(key);

                        if(!o[sub_key]) {
                            o[sub_key] = sub ? {} : val;
                        }

                        unroot(o[sub_key]);
                    };


                    unroot(obj[top]);

                    //array
                } else if(/\[\]$/.test(key)) {
                    key = /(^\w+)/.exec(key)[0];
                    if(!obj[key]) {
                        obj[key] = [];
                    }
                    obj[key].push(val);
                } else {
                    obj[key] = val;
                }

            });

            return obj;
        }

    })
);
