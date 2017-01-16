/*
 backgrid-select2-cell
 http://github.com/wyuenho/backgrid
 Copyright (c) 2013 Jimmy Yuen Ho Wong and contributors
 Licensed under the MIT @license.
 */
(function (root, factory) {

    // CommonJS
    if (typeof exports == "object") {
        require("select2");
        module.exports = factory(root,
            require("underscore"),
            require("backgrid"));
    }
    // Browser
    else factory(root, root._, root.Backgrid);

}(this, function (root, _, Backgrid)  {

    "use strict";

    /**
     Select2CellEditor is a cell editor that renders a `select2` select box
     instead of the default `<select>` HTML element.
     See:
     - [Select2](http://ivaynberg.github.com/select2/)
     @class Backgrid.Extension.Select2CellEditor
     @extends Backgrid.SelectCellEditor
     */
    var Select2CellEditor = Backgrid.Extension.Select2CellEditor = Backgrid.SelectCellEditor.extend({

        /** @property */
        events: {
            "change": "save",
            "close": "close"
        },

        /** @property */
        select2Options: {
            openOnEnter: false
        },

        initialize: function () {
            Backgrid.SelectCellEditor.prototype.initialize.apply(this, arguments);
            this.close = _.bind(this.close, this);
        },

        /**
         Sets the options for `select2`. Called by the parent Select2Cell during
         edit mode.
         */
        setSelect2Options: function (options) {
            this.select2Options = _.extend(options || {});
        },

        /**
         Renders a `select2` select box instead of the default `<select>` HTML
         element using the supplied options from #select2Options.
         @chainable
         */
        render: function () {
            Backgrid.SelectCellEditor.prototype.render.apply(this, arguments);

            this.$el.select2(this.select2Options).on("select2-highlight", $.proxy(function(e){
                if (e.choice.text.indexOf("*") > -1) {
                    $.ajax( {
                        url: "/findScheduleConflictsByPerson/" +
                            this.model.get( 'startTime' )+"/"+this.model.get('endTime')+"/"+e.choice.text.slice(0,-1),
                        dataType: "json",
                        type: "GET",
                        collection: this.collection,
                        scope: this,
                        e: e
                    } ).done( function ( timeConflicts ) {
                        var conflictTooltipText = '';
                        if (timeConflicts.length > 0) {
                            for (var i = 0, len = timeConflicts.length; i < len; i++) {
                                var conflict = timeConflicts[i];
                                var startTime = moment(conflict['startTime']).format('dddd @ h:mmA');
                                var endTime = moment(conflict['endTime']).format('dddd @ h:mmA');
                                conflictTooltipText += conflict['personsName'] + " is scheduled on " + conflict['functionName'] + " from <br/> " + startTime + " - " + endTime + " in the <br/>" + conflict['categoryName'] + ' department. <br>';
                                if (conflict['allowConflict'] == 1) conflictTooltipText += "The lead has allowed double bookings.  ";
                                conflictTooltipText += "<br><br>";
                            }
                            var tooltip = $('<div><p>' + conflictTooltipText + '</p></div>');
                            var selector = (typeof this.e.choice.text.split("'")[1] === 'undefined') ? this.e.choice.text : this.e.choice.text.split("'")[1];
                            var highlightedEl = $("div.select2-result-label:contains('" + selector + "')");
                            $(highlightedEl).data('powertipjq', tooltip);
                            $(highlightedEl).powerTip({
                                placement: 'nw',
                                mouseOnToPopup: true
                            });
                        }
                    });
                }
            },this));


            //use regexp to extrapolate dbname from classname of select2 container, set in select2Options in view
            //var re = /\b dbname-(.*)-/;
            //var dbName = re.exec($(this.$el.siblings()[0]).attr('class'))[1];
            //$("body").append("<div class='backgridPlusButton'>+++</div>");
            //$(".backgridPlusButton").on('click', function(e)
            //{
            //    //e.stopPropagation();
            //    alert('yes');
            //});
            return this;
        },

        /**
         Attach event handlers to the select2 box and focus it.
         */
        postRender: function () {
            var self = this;
            if (self.multiple) self.$el.select2("container").keydown(self.close);
            else self.$el.data("select2").focusser.keydown(self.close);

            self.$el.on("select2-blur", function (e) {
                if (!self.multiple) {
                    e.type = "blur";
                    self.close(e);
                }
                else {
                    // HACK to get around https://github.com/ivaynberg/select2/issues/2011
                    // select2-blur is triggered from blur and is fired repeatibly under
                    // multiple select. Since blue is fired before everything, but focus
                    // is set in focus and click, we need to wait for a while so other
                    // event handlers may have a chance to run.
                    var id = root.setTimeout(function () {
                        root.clearTimeout(id);
                        if (!self.$el.select2("isFocused")) {
                            e.type = "blur";
                            self.close(e);
                        }
                    }, 200);
                }
            }).select2("focus");
        },

        remove: function () {
            this.$el.select2("destroy");
            return Backgrid.SelectCellEditor.prototype.remove.apply(this, arguments);
        }

    });

    /**
     Select2Cell is a cell class that renders a `select2` select box during edit
     mode.
     @class Backgrid.Extension.Select2Cell
     @extends Backgrid.SelectCell
     */
    Backgrid.Extension.Select2Cell = Backgrid.SelectCell.extend({

        /** @property */
        className: "select2-cell",

        /** @property */
        editor: Select2CellEditor,

        /** @property */
        select2Options: null,

        /**
         Initializer.
         @param {Object} options
         @param {Backbone.Model} options.model
         @param {Backgrid.Column} options.column
         @param {Object} [options.select2Options]
         @throws {TypeError} If `optionsValues` is undefined.
         */
        initialize: function (options) {
            Backgrid.SelectCell.prototype.initialize.apply(this, arguments);
            this.select2Options = options.select2Options || this.select2Options;
            var self = this;
            self.editMode = false;

            Select2['cols'] = ( typeof Select2['cols'] != 'undefined' && Select2['cols'] instanceof Array ) ? Select2['cols'] : [];
            Select2['cols'].push(this.column);

            this.listenTo(this.model, "backgrid:edit", function (model, column, cell, editor) {
                console.log('backgrid edit called');
                self.editMode = true;
                if (column.get("name") == this.column.get("name")) {
                    editor.setSelect2Options(this.select2Options);
                    var fieldsMeta = PlantAhead.InitData.gridMeta.fieldsMeta;
                    for (var i = 0, len = fieldsMeta.length; i < len; i++) {
                        if (fieldsMeta[i].name == this.column.get("name")) {
                            if (_.has(fieldsMeta[i].comment, "dependsOn")) {
                                var dependencyData = {};
                                var dependsOn = fieldsMeta[i].comment.dependsOn;
                                dependencyData[dependsOn] = self.model.get(dependsOn);
                                self.$el.data(dependencyData);
                            }
                        }
                    }
                }
            });

            //check if cell was edited, if it has dependencies, clear those dependencies
            this.$el.on("change", function(e){
                var fieldsMeta = PlantAhead.InitData.gridMeta.fieldsMeta;
                //paving way for finding select2 dependencies based on DB
                for (var i = 0, len = fieldsMeta.length; i < len; i++) {
                    if (_.has(fieldsMeta[i].comment, "dependsOn")) {
                        if (fieldsMeta[i].comment.dependsOn == self.column.get("name")) {
                            //clear dependency
                            if (self.model.get(fieldsMeta[i].name) != null) {
                                var dependency = {};
                                var dependencyName = fieldsMeta[i].name;
                                dependency[dependencyName] = null;
                                self.model.set(dependency);

                                //check for another level of dependecies
                                for (var j = 0, len2 = fieldsMeta.length; j < len2; j++) {
                                    if (_.has(fieldsMeta[j].comment, "dependsOn")) {
                                        if (fieldsMeta[j].comment.dependsOn == dependencyName) {
                                            //clear dependency
                                            if (self.model.get(fieldsMeta[j].name) != null) {
                                                var dependency2 = {};
                                                var dependency2Name = fieldsMeta[j].name;
                                                dependency2[dependency2Name] = null;
                                                self.model.set(dependency2);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            });



        }

    });

}));