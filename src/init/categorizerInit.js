/**
 * Created by caseri on 8/08/16.
 */

function initCategorizerView(tableName) {
    PlantAhead.namespace(
        "PlantAhead.App.Categorizer",
        Backbone.View.extend({
            el:"#appView_container",
            initialize : function() {
                //find all FK fields
                this.categorizerModel = new Backbone.Model();
                this.uxUtils = new PlantAhead.Utils.uxUtils();
                this.collection = this.uxUtils.mapFkNames(new Backbone.Collection(PlantAhead.InitData.collectionJSON));
                var tableName = typeof JSON.parse(PlantAhead.InitData.tableMeta.tableComments).title != 'undefined' ? JSON.parse(PlantAhead.InitData.tableMeta.tableComments).title : PlantAhead.InitData.tableMeta.tableName;
                this.categorizerModel.set('tableName', tableName);
                this.collection.url = "/api/"+PlantAhead.InitData.tableMeta.tableName;

                //this._initTitle();
                //this.$el.prepend(this.categorizerTitle.render().el);
                //this.$list = $('#categorizerTitle');
                
                var sortModel = new PlantAhead.Models.CategorizerSortModel();

                var sortURL = window.location.pathname.split("/categorizer/" + PlantAhead.InitData.tableMeta.tableName + "/")[1];
                if (typeof sortURL != 'undefined') {
                    if(sortURL.length > 0)
                    {
                        //IMMEDIATELY CONVERT % unicode chars to human readable URL
                        if ( sortURL.indexOf( "%" ) != -1 )
                        {
                            sortURL = sortModel.decode( sortURL );
                            window.history.pushState( "object or string", "Title", sortURL );
                        }
                        //this.categorizerModel.set('selectedCategory', sortModel.decode(sortURL).reifierType);
                        //TODO setup the categorizer view with a var to decide how to reify the first level

                    }
                }


                this.categorizerView = new PlantAhead.Views.CategorizerView({
                    model : this.categorizerModel,
                    collection: this.collection,
                    parentView : this,
                    sortModel: sortModel,
                    sortURL: sortURL
                });


                //this._initCatSelectModal();

                //this.categorizerModel.set('selectedCategoryName', 'Location');
                //this.categorizerModel.set('selectedCategory', 'farmAreaID');
                //remove selectedCategory badge from badgeFields


                this.render();
            },

            initWunderlist: function(){
                var WunderlistSDK = window.wunderlist.sdk;
                // Returns an instance of the Wunderlist SDK setup with the correct client ID and user access token
// and sets up a single WebSocket connection for REST over socket proxying
                var WunderlistAPI = new WunderlistSDK({
                    'accessToken': '6aa22fadd744b36eacd1c0cda3bd5f5dca6ca57c635c55e0ad0b239b94f8',
                    'clientID': '52d182a6e76a3f415fe9'
                });

                WunderlistAPI.initialized.done(function () {
                    // Where handleListData and handleError are functions
                    // 'http' here can be replaced with 'socket' to use a WebSocket connection for all requests
                    WunderlistAPI.http.lists.all()
                        // handleListData will be called with the object parsed from the response JSON
                        .done(handleListData)
                        // handleError will be called with the error/event
                        .fail(handleError);
                });
            },

            _initCatSelectModal : function () {
                var self = this;
                var fkFields = _.filter(PlantAhead.InitData.tableMeta.fieldsMeta, function(field){return field.type=='select2'});

                //populate Radio group with FK field names
                var radioGroup = "<h3>Categorize Tasks By:</h3> <form id='categorySelector' action='#'>";
                _.each(fkFields, function(field){
                    //check for alias in comments field, if so use it as human readable name
                    var fieldName = typeof field.comment.alias != 'undefined' ? field.comment.alias : field.name;
                    radioGroup += "<p><input name='category' type='radio' data-fieldName='"+fieldName+"' id='"+field.name+"'/>" +
                    "<label for='"+field.name+"'>"+fieldName+"</label>";
                });
                radioGroup += "</form>";

                this.catSelectModal = new PlantAhead.Views.Modal({
                    text: radioGroup,
                    confirmBtn: 'Categorize!',
                    onConfirm: function(e){
                        self.categorizerModel.set('selectedCategoryName', $('input[name="category"]:checked', '#categorySelector').data().fieldname);
                        self.categorizerModel.set('selectedCategory', $('input[name="category"]:checked', '#categorySelector').attr('id'));
                        //remove selectedCategory badge from badgeFields
                        self.$el.prepend(self.categorizerTitle.render().el);
                    },
                    cancelBtn: 'Cancel'
                });
            },

            _initTitle: function (){
                var self = this;
                var CategorizerTitle = Backbone.View.extend({
                    id:"categorizerTitle",
                    tagName: "ul",
                    //materialize button classes
                    className: "collapsible",
                    events: {
                        "click":"onClick"
                    },
                    template: _.template($('#categorizerTitle_template').html()),

                    //pass options object through initialization call
                    initialize: function(options) {
                        this.options = options || {};
                    },

                    render: function () {
                        this.$el.html(this.template({
                            text: self.categorizerModel.get('selectedCategoryName'),
                            tableName: self.categorizerModel.get('tableName')
                        }));
                        this.$el.data({collapsible:"accordion"});
                        return this;
                    },

                    onClick : function (e) {
                        //self.catSelectModal.$el.openModal();
                    }
                });

                self.categorizerTitle = new CategorizerTitle();

            },

            render : function () {
                //TODO restore modal by uncommenting here
                //this.$el.append(this.catSelectModal.render().el);
                this.$el.append(this.categorizerView.render().el);

                $('ul:first').find('.grid-link').addClass('logoBadge');
                //this.catSelectModal.$el.openModal({
                //    dismissible: false
                //});
            }
        })
    );

    if (typeof(PlantAhead.Runtime) == "undefined")
        PlantAhead.Runtime = {};
    PlantAhead.Runtime.Categorizer = new PlantAhead.App.Categorizer();

}

