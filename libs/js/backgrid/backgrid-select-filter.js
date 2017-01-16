/*
  Backgrid select-filter extension
  http://github.com/amiliaapp/backgrid-select-filter

  Copyright (c) 2014 Amilia Inc.
  Written by Martin Drapeau
  Licensed under the MIT @license
 */
(function(){
  var SelectFilter = Backgrid.Extension.SelectFilter = Backbone.View.extend({
    tagName: "select",
    className: "backgrid-filter",
    template: _.template([
      "<% for (var i=0; i < options.length; i++) { %>",
      "  <option value='<%=JSON.stringify(options[i].value)%>' <%=options[i].value === initialValue ? 'selected=\"selected\"' : ''%>><%=options[i].label%></option>",
      "<% } %>"
    ].join("\n")),
    events: {
      "change": "onChange",
      "focus": "onFocus"
    },
    defaults: {
      selectOptions: undefined,
      field: undefined,
      dependsOn : undefined,
      clearValue: null,
      initialValue: undefined,
      makeMatcher: function(value) {
        return function(model) {
          return model.get(this.field) == value;
        };
      }
    },
    initialize: function(options) {
      SelectFilter.__super__.initialize.apply(this, arguments);

      _.defaults(this, options || {}, this.defaults);
      if (_.isEmpty(this.selectOptions) || !_.isArray(this.selectOptions)) throw "Invalid or missing selectOptions.";
      if (_.isEmpty(this.field) || !this.field.length) throw "Invalid or missing field.";
      if (this.initialValue === undefined) this.initialValue = this.clearValue;

      var collection = this.collection = this.collection.fullCollection || this.collection;
      var shadowCollection = this.shadowCollection = collection.clone();

      this.listenTo(collection, "add", function (model, collection, options) {
        shadowCollection.add(model, options);
      });
      this.listenTo(collection, "remove", function (model, collection, options) {
        shadowCollection.remove(model, options);
      });
      this.listenTo(collection, "sort", function (col) {
        if (this.currentValue() == this.clearValue) shadowCollection.reset(col.models);
      });
      this.listenTo(collection, "reset", function (col, options) {
        options = _.extend({reindex: true}, options || {});
        if (options.reindex && options.from == null && options.to == null) {
          shadowCollection.reset(col.models);
        }
      });
    },
    render: function() {
      this.$el.empty().append(this.template({
        options: this.selectOptions,
        initialValue: this.initialValue
      }));
			this.onChange();
      return this;
    },

    currentValue: function() {
      return JSON.parse(this.$el.val());
    },
    onChange: function(e) {
      var col = this.collection,
        field = this.field,
        value = this.currentValue(),
        matcher = _.bind(this.makeMatcher(value), this);

      if (col.pageableCollection)
        col.pageableCollection.getFirstPage({silent: true});

      if (value !== this.clearValue)
        col.reset(this.shadowCollection.filter(matcher), {reindex: false});
      else
        col.reset(this.shadowCollection.models, {reindex: false});
    },
    onFocus: function(e){
      var self = this;
      var collection = this.collection,
              field = this.field,
              value = this.currentValue(),
              dependsOn = this.dependsOn;

              self.dependency = '';
      var colName = field;
      var dbName = colName.slice( 0, -2 );
      var ajaxPayload = {};

      var fieldID = _.find( collection.tableMeta.fieldsMeta, function ( f ) { if ( f.name == colName ) return f } );
      if ( typeof fieldID.comment.dependsOn != 'undefined' )
      {
        ajaxPayload.dependency = fieldID.comment.dependsOn;
        ajaxPayload.dependentVal = dependsOn.el.value;
      }


        $.ajax( {
          async: false,
          url: "/api/" + dbName,
          data: ajaxPayload
        } ).done( function ( data )
        {
          var values = [];
          data = JSON.parse( data );
          _.each( data, function ( model )
          {
            values.push( [model[dbName + "Name"], model["id"]] );
          } );

          self._optionValues =_.union([{label: "All", value: null}],
                  _.map(values, function(o) {return {label: o[0], value: o[1]};}))

          //self._optionValues = [{label: values, value: values}];
          //self.lastUpdated = new Date().getTime();
        } );


      this.selectOptions = self._optionValues;
      this.render();
    }
  });
}).call(this);
