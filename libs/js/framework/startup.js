///*
//PlantAhead Application is the LAST thing to load.  After all the other application files are loaded, we
//then start this app.
// */

//extend Jquery to include width detection function for text given font
$.fn.textWidth = function(text, font, rotation) {

    if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span>').hide().appendTo(document.body);
    $.fn.textWidth.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
    var width = $.fn.textWidth.fakeEl.width();
    var height = $.fn.textWidth.fakeEl.height();

    var boundingBox = {};
    boundingBox.width = Math.sin(rotation) * height + Math.cos(rotation) * width;
    boundingBox.height = Math.sin(rotation) * width + Math.cos(rotation) * height;
    return boundingBox;
};

//Define Application
PlantAhead.namespace(
    "PlantAhead.App",
    Backbone.View.extend({
        initialize : function() {
            var firstRun = true;
            var self = this;

            this.$el = $('body');

            this.mapView = new PlantAhead.Views.Map({});

            this.mapRouter = new PlantAhead.Routers.MapRouter({});

            this.mapRouter.on('route:cropGrid', function( queryString ){
                if (firstRun) {
                    var tableName = 'crops';
                    var apiUri = (queryString) ? tableName + queryString : tableName;
                    var isEditable = true;
                    self.foreignKeyCollections = {};
                    firstRun = false;

                    var gridCollection = self.getCropGridCollection(apiUri);
                    var cropTableMeta = self.getCropTableMeta(tableName);
                    self.gridView = new PlantAhead.Views.CropGridView({
                        attributes: {
                            tableName: tableName,
                            gridCollection: gridCollection,
                            tableMeta: cropTableMeta,
                            foreignKeyCollections: self.foreignKeyCollections,
                            isEditable: isEditable
                        }
                    });

                    var cropsFormComments = self.getFormMeta(tableName);
                    var cropsFormFields = self.getFormFields(tableName);
                    var cropsForm = new PlantAhead.Views.CropsFormModalView({
                        attributes: {
                            tableName: tableName,
                            comments: cropsFormComments,
                            fields: cropsFormFields,
                            model: new PlantAhead.Models.FormModel
                        }
                    });
                   cropsForm.attributes.fields.fetch({ reset: true, async: false} );
                   cropsForm.attributes.comments.fetch({ reset: true, async: false} );
                    //self.formView.render();


                    self.mapView.cropsForm = cropsForm;
                    //self.mapView.cropsForm.el = $("#cropsFormModal");
                    self.mapView.cropsForm.render();
                    self.mapView.cropGridView = self.gridView;
                    self.mapView.cropsCollection = gridCollection;
                    self.mapView.cropGridView.render();
                    self.mapView.render();

                }
            });

            this.mapRouter.on('route:calendar', function(){

                var EventsCollection = Backbone.Collection.extend({
                    model: PlantAhead.Models.EventModel,
                    url: "/api/events"
                });

                var eventsCollection = new EventsCollection();
                this.calendarView = new PlantAhead.Views.CalendarView({collection: eventsCollection}).render();
                eventsCollection.fetch({reset:true});
            });

            this.mapRouter.on('route:grid', function(tableName, queryString){
                if (firstRun) {
                    //default grid is NOT editable
                    var isEditable = false;
                    var pageSize = 15;
                    var currentPage = 1;
                    firstRun = false;
                    self.foreignKeyCollections = {};

                    //catch URL query parameter if they exist
                    if (queryString != null) {
                        if (queryString.slice(-1) == "&") queryString = queryString.slice(0, -1);
                        var params = self.parseQueryString(queryString);
                        //set pageSize if desired, otherwise default to 15
                        if (typeof params.isEditable !== 'undefined') {
                            isEditable = (params.isEditable == "true");
                        }
                        var pageSize = (typeof params.per_page !== 'undefined') ? parseInt(params.per_page) : 15;
                        var currentPage = (typeof params.page !== 'undefined') ? parseInt(params.page) : 1;
                    }

                    var gridCollection = self.getGridCollection(tableName, queryString, pageSize, currentPage);

                    self.gridView = new PlantAhead.Views.GridView({
                        attributes: {
                            tableName: tableName,
                            filterParams: params,
                            gridCollection: gridCollection,
                            foreignKeyCollections: self.foreignKeyCollections,
                            isEditable: isEditable
                        }
                    });
                    self.gridView.render();

                    if(params){
                        self.gridView._initFilter(params);
                        //self.gridView.filterAjax();
                    }
                    //$("#navBar").append("<a class='page-title'>Purification Gathering 2016 Personnel</a>");
                    $("#sub-navBar").hide();
                }
                else {
                    //TODO really handle subsequent router calls,  as of now it just handles the first one
                }
            });

            this.mapRouter.on('route:form', function(tableName){
                //var formModel = self.getFormModel(tableName);
                //var self = this;
                //var formFields = self.getFormFields(tableName);
                //self.FormModel = PlantAhead.Models.FormModel;
                //var formCollection = self.getFormCollection(tableName);

                var comments = self.getFormMeta(tableName);
                var fields = self.getFormFields(tableName);
                //var cropTableMeta = self.getCropTableMeta(tableName);

                switch(tableName){
                    case 'crops':
                        self.formView = new PlantAhead.Views.CropsFormView({
                            attributes: {
                                tableName: tableName,
                                comments: comments,
                                fields: fields,
                                model: new PlantAhead.Models.FormModel
                            }
                        });
                        break;
                    default:
                        self.formView = new PlantAhead.Views.FormView({
                            attributes: {
                                tableName: tableName,
                                comments: comments,
                                fields: fields,
                                model: new PlantAhead.Models.FormModel
                            }
                        });
                        break;
                }

                self.formView.attributes.fields.fetch({ reset: true, async: false} );
                self.formView.attributes.comments.fetch({ reset: true, async: false} );
                self.formView.render();


            });

            Backbone.history.start({root:'/map'});
            //TODO instantiate menu views here
        },

        getFormFields : function(tableName) {
            self.formModel = PlantAhead.Models.FormModel;
            //check if there is a queryString, if so append it to collection url
            var formCollection = Backbone.Collection.extend({
                model: self.formModel,
                url: "/api/tableFields/"+tableName


            });
            formCollection = new formCollection();
            return formCollection;

        },
            
        getCropGridCollection : function(tableName) {
        self.GridModel = PlantAhead.Models.GridModel;
        //check if there is a queryString, if so append it to collection url
        var gridCollection = Backbone.Collection.extend({
            //TODO abstract this model assignment PERHAPS like this? model: function() { return 'PlantAhead.Models.' + tableName + 'Model' }; ?????
            model: self.GridModel,
            url: "/api/"+tableName


        });

            //if('tableMeta' in resp && 'fkRelations' in resp.tableMeta){
            //    _.each(resp.tableMeta.fkRelations, function(r) {
            //        var fkCollection = Backbone.Collection.extend({
            //            url: "/api/"+r.foreign_table
            //        });
            //        if (typeof self.foreignKeyCollections[r.foreign_table] === 'undefined'){
            //            self.foreignKeyCollections[r.foreign_table] = new fkCollection();
            //            self.foreignKeyCollections[r.foreign_table].fetch({reset:true});
            //        }
            //    });
            //    this.tableMeta.fkRelations = resp.tableMeta.fkRelations;
            //}

            gridCollection = new gridCollection();
            return gridCollection;

        },

        getCropTableMeta : function(tableName) {
            self.GridModel = PlantAhead.Models.GridModel;
            //check if there is a queryString, if so append it to collection url
            var cropTableMeta = Backbone.Collection.extend({
                model: self.GridModel,
                url: "/api/tableMeta/"+tableName


            });
            cropTableMeta = new cropTableMeta();
            return cropTableMeta;

        },

        getFormMeta : function(tableName) {
            self.FormModel = PlantAhead.Models.FormModel;
            //check if there is a queryString, if so append it to collection url
            var cropTableMeta = Backbone.Collection.extend({
                model: self.FormModel,
                url: "/api/formMeta/"+tableName


            });
            cropTableMeta = new cropTableMeta();
            return cropTableMeta;

        },




        getComputedFields : function(obj){
            var computedFields = _.filter(obj, function(o){ return o.type == 'computed' });
            return computedFields;
        },

        getGridCollection : function(tableName, queryString, numRecords, currentPage) {
            var self = this;
            //TODO implement Calculated fields again.  Disabling presently to reduce complexity and API calls
            //$.ajax({
            //    url: "/api/tableMeta/"+tableName,
            //    async: false
            //}).done(function(res) {
            //    var computedFields = self.getComputedFields(JSON.parse(res).tableMeta.fieldsMeta);
            //    if (computedFields) {
            //        //instantiate object to store computations
            //        var computed = {};
            //        _.each(computedFields, function (field) {
            //            //get array of dependencies
            //            var depends = field.comment.compute.depends;
            //            depends.foreignFields = [];
            //            for (var i = 0, len = depends.length; i < len; i++) {
            //                if (depends[i].split(".")[1] !== undefined) {
            //                    var declaration = depends[i];
            //                    depends[i] = declaration.split(".")[0];
            //                    depends.foreignFields[i] = {};
            //                    depends.foreignFields[i].refTableName = declaration.split(".")[0].slice(0,-2);
            //                    depends.foreignFields[i].refTableAttrName = declaration.split(".")[1];
            //                }
            //            }
            //            //remove _computed from the end of the field name
            //            var fieldName = field.name.split("_")[0];
            //            var operator = field.comment.compute.operator;
            //
            //            switch (operator) {
            //                case "multiply":
            //                    if (depends.foreignFields[0] !== undefined && depends.foreignFields[1] === undefined) {
            //                        var get = function (fields){
            //                            return self.foreignKeyCollections[depends.foreignFields[0].refTableName].get(fields[depends[0]]).get(depends.foreignFields[0].refTableAttrName) * fields[depends[1]];
            //                        }
            //                    } else {
            //                        var get = function (fields) {
            //                            return fields[depends[0]] * fields[depends[1]];
            //                        }
            //                    }
            //                    break;
            //                default:
            //                    var get = function (fields){
            //                        return fields[depends[0]] + fields[depends[1]];
            //                    }
            //                    break;
            //            }
            //
            //            computed[fieldName] = {
            //                depends: depends,
            //                get : get,
            //                toJSON : false
            //            }
            //
            //        });
            //        self.GridModel = PlantAhead.Models.GridModel.extend({
            //            computed:computed
            //        })
            //    } else {
            //        self.GridModel = PlantAhead.Models.GridModel;
            //    }
            //});

            self.GridModel = PlantAhead.Models.GridModel;
            //check if there is a queryString, if so append it to collection url
            var query = (queryString) ? "?"+queryString : "";
            var gridCollection = Backbone.PageableCollection.extend({
                //TODO abstract this model assignment PERHAPS like this? model: function() { return 'PlantAhead.Models.' + tableName + 'Model' }; ?????
                model: self.GridModel,
                url: "/api/"+tableName + query,
                state: {
                    pageSize: numRecords,
                    currentPage: currentPage
                },
                queryParams: {
                    totalPages: null,
                    totalRecords: null,
                    sortKey: "sort"
                },
                parseState: function (resp, queryParams, state, options) {
                    this.tableMeta = resp.tableMeta;
                    //this.fkRelations = resp.tableMeta.fkRelations;

                    if('tableMeta' in resp && 'fkRelations' in resp.tableMeta){
                        _.each(resp.tableMeta.fkRelations, function(r) {
                            var fkCollection = Backbone.Collection.extend({
                            url: "/api/"+r.foreign_table
                            });
                            if (typeof self.foreignKeyCollections[r.foreign_table] === 'undefined'){
                                self.foreignKeyCollections[r.foreign_table] = new fkCollection();
                                self.foreignKeyCollections[r.foreign_table].fetch({reset:true});
                            }
                        });
                        this.tableMeta.fkRelations = resp.tableMeta.fkRelations;
                    }

                    return {totalRecords: parseInt(resp.totalRecords)};
                },
                parseRecords: function (resp, options) {
                    return resp.items;
                }
            });
            gridCollection = new gridCollection();
            return gridCollection;
        },

        parseQueryString : function(queryString){
            var params = {};

            _.map(decodeURI(queryString).split(/&/g),function(el,i){
                var keyValArray = el.split('=');
                if(keyValArray.length >= 1){
                    if (keyValArray[0].indexOf("[]")>-1) {
                        //catch arrays sent in url parameters
                        if (typeof params[keyValArray[0]] === 'undefined')
                            params[keyValArray[0]] = [];
                        params[keyValArray[0]].push(keyValArray[1]);
                    } else {
                        var val = undefined;
                        if (keyValArray.length == 2)
                            val = keyValArray[1];
                        params[keyValArray[0]] = val;
                    }
                }
            });

            return params;
        }
    })
);

//Start Application, this namespace is available at runtime...
PlantAhead.Runtime = new PlantAhead.App();
