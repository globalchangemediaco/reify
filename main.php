<?php
require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app=new \Slim\Slim();

$app->get('/',function() {
    echo "\n";
    echo "\n";
    echo "<!DOCTYPE html>\n";
    echo "<html   >\n";
    echo "\n";
    echo "<head   >\n";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no' />\n";
    echo "<meta name='description' content='' />\n";
    echo "<meta name='keywords' content='' />\n";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />\n";
    echo "\n";
    echo "<script type = 'text/template' id='categorizerTitle_template'>\n";
    echo "\n";
    echo "            <li>\n";
    echo "                <div class=\"collapsible-header\"><h5 class=\"center-align\"><strong><%= tableName %></strong> categorized by <em><%= text %></em></h5></div>\n";
    echo "            </li>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='categorizerSection_template'>\n";
    echo "\n";
    echo "            <li class=\"<%= active %> <%= name %>\">\n";
    echo "                <div class=\"collapsible-header section-header <%= active %>\">\n";
    echo "                <span class=\"badge <%= badgeColor %> category-badge\">\n";
    echo "                        <i class=\"material-icons badge-icon grid-link\"><%= badgeIcon %></i>\n";
    echo "                </span>\n";
    echo "                <span class=\"truncate section-header-text\"><strong><%= title %></strong></span>\n";
    echo "                <div class=\"badge-container\">\n";
    echo "                    <!--<span class=\"badge black\"><i class=\"material-icons badge-icon grid-link\">open_in_browser</i></span>-->\n";
    echo "                    <span class=\"badge green\"><%= completed %></span>\n";
    echo "                    <span class=\"badge red\"><%= incomplete %></span>\n";
    echo "                </div>\n";
    echo "                </div>\n";
    echo "                <div class=\"collapsible-body\">\n";
    echo "\n";
    echo "                </div>\n";
    echo "            </li>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='categorizerAddNew_template'>\n";
    echo "\n";
    echo "            <li>\n";
    echo "                <div class=\"collapsible-header section-header\">\n";
    echo "                <span class=\"badge category-badge <%= badgeColor %>\">\n";
    echo "                        <i class=\"material-icons badge-icon\">add</i>\n";
    echo "                </span>\n";
    echo "                <span class=\"editMe truncate section-header-text\"><strong><%= title %></strong></span>\n";
    echo "                </div>\n";
    echo "                <div class=\"collapsible-body\"></div>\n";
    echo "            </li>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='categorizerAddNewEdit_template'>\n";
    echo "\n";
    echo "            <li>\n";
    echo "                <div class=\"collapsible-header section-header\">\n";
    echo "                <span class=\"badge category-badge <%= badgeColor %>\">\n";
    echo "                        <i class=\"material-icons badge-icon\">edit</i>\n";
    echo "                </span>\n";
    echo "                <span class=\"truncate section-header-text\"><strong><input type=\"text\" /></strong></span>\n";
    echo "                <span class=\"badge grey\">\n";
    echo "                    <i class=\"saveMe badge-icon material-icons\">save</i>\n";
    echo "                </span>\n";
    echo "                </div>\n";
    echo "            </li>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='badge_template'>\n";
    echo "\n";
    echo "            <i class=\"material-icons badge-icon <%= badgeFunction %>\"><%= iconName %></i><span class=\"badge-text\"><%= text %></span>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='categorizerItem_template'>\n";
    echo "\n";
    echo "            <div class=\"collapsible-header valign-wrapper\">\n";
    echo "            <span class=\"checkboxComplete\">\n";
    echo "              <input type=\"checkbox\" class=\"mark-complete\" id=\"complete<%= id %>\" <%= checked %> />\n";
    echo "              <label class=\"valign\" for=\"complete<%= id %>\"></label>\n";
    echo "            </span>\n";
    echo "            <span class=\"card-title truncate valign\" ><%= task %></span>\n";
    echo "\n";
    echo "            </div>\n";
    echo "            <div class=\"collapsible-body collapsible-body-item\"></div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridView_template'>\n";
    echo "\n";
    echo "            <div id=\"gv\">\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='collection_template'>\n";
    echo "\n";
    echo "        <ul class=\"collection with-header\">\n";
    echo "            <li class=\"collection-header\"><h4><%= headerText %> </h4></li>\n";
    echo "             <% collection.each(function(item){ %>\n";
    echo "                <li class=\"collection-item\"><div><a href=\"/grid/harvestOrderItem/harvestOrderID[select2]=<%= item.id %>\" >Order #: <%= item.id %> - Date: <%= moment(item.attributes.timestamp).format(\"MMMM Do YYYY, h:mm a\") %></a></div></li>\n";
    echo "             <% }); %>\n";
    echo "         </ul>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='navBar_template'>\n";
    echo "\n";
    echo "        <nav>\n";
    echo "            <div class=\"nav-wrapper row z-depth-1\" style=\"overflow-x:auto\">\n";
    echo "            <div class=\"col s6 header\">\n";
    echo "              <a href=\"#!\" class=\"brand-logo\"><img class=\"hide-on-med-and-down\" style=\"max-height:60px;\" src=\"\"/></a>\n";
    echo "            </div>\n";
    echo "            <div class=\"col l6 s12\" style=\"min-width:550px;\">\n";
    echo "              <ul id=\"nav-mobile\"  class=\"right\">\n";
    echo "              </ul>\n";
    echo "             </div>\n";
    echo "             </div>\n";
    echo "        </nav>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='navBarItem_template'>\n";
    echo "\n";
    echo "          <a class=\"<%= className %>\" href=\"#\"><%= text %></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='navBarDatePicker_template'>\n";
    echo "\n";
    echo "          <label for=\"navBarDatePicker\" class=\"active\"><%= labelText %></label>\n";
    echo "          <input id=\"navBarDatePicker\" type=\"date\" class=\"datepicker\">\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='navBarDatetimePicker_template'>\n";
    echo "\n";
    echo "          <input id=\"navBarDatetimePicker\" class=\"bsm-datetimepicker\">\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridControlItem_template'>\n";
    echo "\n";
    echo "          <a class=\"\" href=\"#\"><%= text %></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='button_template'>\n";
    echo "\n";
    echo "          <a href=\"#\"><%= text %></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='chartControl_template'>\n";
    echo "\n";
    echo "            <div id=\"chartControl\" class=\"col s12\">\n";
    echo "                <ul></ul>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridControl_template'>\n";
    echo "\n";
    echo "            <div id=\"gridControl\" class=\"col s12\">\n";
    echo "                <ul></ul>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='navBarUserSelector_template'>\n";
    echo "\n";
    echo "\n";
    echo "          <option value=\"\" disabled selected>Who Are You?</option>\n";
    echo "          <% _.each(users, function(user){ %>\n";
    echo "                <option value=\"<%= user.id %>\"><%= user.customerName %></option>\n";
    echo "          <% }); %>\n";
    echo "\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='selecter_template'>\n";
    echo "\n";
    echo "          <select class=\"browser-default\" >\n";
    echo "              <option value=\"\" disabled selected><%= title %></option>\n";
    echo "              <% _.each(options, function(option){ %>\n";
    echo "                    <option value=\"<%= option[0] %>\"><%= option[1] %></option>\n";
    echo "              <% }); %>\n";
    echo "          </select>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridAddRow_template'>\n";
    echo "\n";
    echo "          <a onclick=\"$.publish(&quot;gardenMap:gridAddRowBtn&quot;)\" class=\"gridControl gridAddRowBtn btn-floating btn-large waves-effect waves-light\"><i class=\"material-icons\">+</i></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridDupRow_template'>\n";
    echo "\n";
    echo "          <a onclick=\"$.publish(&quot;gardenMap:gridAddRowBtn&quot;, &quot;dup&quot;)\" style=\"margin-right: 70px\" class=\"gridControl gridAddRowBtn btn-floating btn-large waves-effect waves-light \"><i class=\"material-icons\">++</i></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='gridDeleteRow_template'>\n";
    echo "\n";
    echo "          <a onclick=\"$.publish(&quot;gardenMap:gridDeleteRowBtn&quot;)\" style=\"margin-right: 140px\" class=\"gridControl gridAddRowBtn btn-floating btn-large waves-effect waves-light \"><i class=\"material-icons\">-</i></a>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='powerTip_template'>\n";
    echo "\n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='powerTipResolution_template'>\n";
    echo "\n";
    echo "                <span>\n";
    echo "                <%= personName %> is already scheduled in the <%= categoryName%> department for <%= functName %> from <br/>\n";
    echo "                <%=conflictStartTime %> to <%= conflictEndTime %> <br/>\n";
    echo "                Contact <%= functLead %> to resolve this conflict. <br/>\n";
    echo "                <a class=\"resolveConflict\">Resolve</a>\n";
    echo "                </span>\n";
    echo "                \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='modal_template'>\n";
    echo "\n";
    echo "            <div class=\"modal-content\">\n";
    echo "              <h4><%= text %></h4>\n";
    echo "            </div>\n";
    echo "            <div class=\"modal-footer\">\n";
    echo "              <a class=\"modal-action modal-close modal-confirm waves-effect waves-green btn-flat \"><%= confirmBtn %></a>\n";
    echo "              <a class=\"modal-action modal-close modal-cancel waves-effect waves-green btn-flat \"><%= cancelBtn %></a>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='addByRepeatSchemeModal_template'>\n";
    echo "\n";
    echo "            <div class=\"modal-content\">\n";
    echo "              <h4>Create a Repeat Scheme</h4>\n";
    echo "              <% if(model){ %>\n";
    echo "                <table><tr>\n";
    echo "                <td><%= model.get(\"schedCategoryName\") %></td>\n";
    echo "                <td><%= model.get(\"schedFunctionName\") %></td>\n";
    echo "                <td><%= model.get(\"schedFunctionSpecificName\") %></td>\n";
    echo "                <td><%= model.get(\"scheduleToolPeopleName\") %></td>\n";
    echo "                <td><%= moment(model.get(\"startTime\")).format(\"ddd MMM DD h:mm A\") %></td>\n";
    echo "                <td><%= moment(model.get(\"endTime\")).format(\"ddd MMM DD h:mm A\") %></td>\n";
    echo "                </tr></table>\n";
    echo "              <!-- <select id=\"addByRepeatSchemeModalSelect\">\n";
    echo "                  <option value=\"\" disabled selected>Repeat...</option>\n";
    echo "                  <option value=\"weekly\">Weekly</option>\n";
    echo "              </select> -->\n";
    echo "              <p>Repeat weekly from <%= moment(model.get(\"startTime\")).format(\"ddd MMM DD YYYY\") %> until: </p>\n";
    echo "              <input id=\"addByRepeatSchemeModalDatetimePicker\" class=\"bsm-datetimepicker\">\n";
    echo "              <% } %>\n";
    echo "            </div>\n";
    echo "            <div class=\"modal-footer\">\n";
    echo "              <!-- <a href=\"#!\" class=\"modal-action modal-close modal-confirm waves-effect waves-green btn-flat \">Save</a> -->\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-cancel waves-effect waves-green btn-flat \">Done</a>\n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='resolutionModal_template'>\n";
    echo "\n";
    echo "            <div class=\"modal-content\">\n";
    echo "              <h4><%= text %></h4>\n";
    echo "              <p>You are scheduling: </p>\n";
    echo "              <table class=\"nowSchedulingTable\">\n";
    echo "                  <tr class=\"nowSchedulingLabels\">\n";
    echo "                      <td>Function Category</td>\n";
    echo "                      <td>Function Name</td>\n";
    echo "                      <td>Start</td>\n";
    echo "                      <td>End</td>\n";
    echo "                  </tr>\n";
    echo "                  <tr class=\"nowSchedulingData\">\n";
    echo "                      <td><%=  nowScheduling.categoryName  %> </td>\n";
    echo "                      <td><%=  nowScheduling.functName  %> </td>\n";
    echo "                      <td><%=  nowScheduling.conflictStartTime  %> </td>\n";
    echo "                      <td><%=  nowScheduling.conflictEndTime %> </td>\n";
    echo "                  </tr>\n";
    echo "              </table>\n";
    echo "              <p>You tried to schedule <%= conflictPerson.scheduleToolPeopleName %>. Find someone else: </p>\n";
    echo "              <select>\n";
    echo "              <option value=\" \">Qualified & Available</option>\n";
    echo "              <option value=\" \"> </option>\n";
    echo "              <% _.each(collection.qualifiedAvailable, function(qa){ %>\n";
    echo "                <option value=\"<%= qa.scheduleToolPeopleID %>\"><%= qa.scheduleToolPeopleName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "              <select>\n";
    echo "              <option value=\" \">Qualified & Conflict</option>\n";
    echo "              <option value=\" \"> </option>\n";
    echo "              <% _.each(collection.qualified, function(qu){ %>\n";
    echo "                <option value=\"<%= qu.scheduleToolPeopleID %>\"><%= qu.scheduleToolPeopleName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "              <select>\n";
    echo "              <option value=\" \">Available</option>\n";
    echo "              <option value=\" \"> </option>              <% _.each(collection.available, function(av){ %>\n";
    echo "                <option value=\"<%= av.scheduleToolPeopleID %>\"><%= av.scheduleToolPeopleName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "               <select>\n";
    echo "              <option value=\" \">Conflicts</option>\n";
    echo "              <option value=\" \"> </option>              <% _.each(collection.conflicts, function(ot){ %>\n";
    echo "                <option value=\"<%= ot.scheduleToolPeopleID %>\"><%= ot.scheduleToolPeopleName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "              <% if(selectedPerson != \"\"){ %>\n";
    echo "              <p><%= selectedPerson %>&#8217;s Schedule: </p>\n";
    echo "              <table>\n";
    echo "              <% if(scheduledItemsForSelected.length < 1){ %>\n";
    echo "                 <p><b>Looks like <%= selectedPerson %> isn&#8217;t scheduled for anything yet! </b></p>\n";
    echo "              <% } %>\n";
    echo "                <% } %>\n";
    echo "\n";
    echo "              <% _.each(scheduledItemsForSelected, function(item){ %>\n";
    echo "                <tr>\n";
    echo "                <td> <%=  item.schedCategory  %> </td>\n";
    echo "                <td> <%=  item.schedFunction  %> </td>\n";
    echo "                <% if(moment(item.startTime).format(\"MMM DD h:mm A\") == nowScheduling.conflictEndTime ) { %>\n";
    echo "\n";
    echo "                    <td class=\"highlight\"> <%=  moment(item.startTime).format(\"MMM DD h:mm A\")  %> </td>\n";
    echo "                <% } else { %>\n";
    echo "                    <td> <%=  moment(item.startTime).format(\"MMM DD h:mm A\")  %> </td>\n";
    echo "                <% } %>\n";
    echo "                <td> <%=  moment(item.endTime).format(\"MMM DD h:mm A\") %> </td>\n";
    echo "\n";
    echo "                </tr>\n";
    echo "              <% }) %>\n";
    echo "              </table>\n";
    echo "            </div>\n";
    echo "            <div class=\"modal-footer\">\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-confirm waves-effect waves-green btn-flat \">Save <%= selectedPerson %> </a>\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-cancel waves-effect waves-green btn-flat \">Cancel</a>\n";
    echo "            </div>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='addNewPanelModal_template'>\n";
    echo "\n";
    echo "            <div class=\"modal-content\">\n";
    echo "              <h4><%= text %></h4>\n";
    echo "              <select id=\"appID\">\n";
    echo "              <option value=\" \">Apps</option>\n";
    echo "              <% _.each(apps, function(app){ %>\n";
    echo "                <option value=\"<%= app.id %>\"><%= app.appName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "              <select id=\"tableName\">\n";
    echo "              <option value=\" \">Tables</option>\n";
    echo "              <% _.each(tables, function(table){ %>\n";
    echo "                <option value=\"<%= table.tableName %>\"><%= table.tableName %></option>\n";
    echo "              <% })%>\n";
    echo "              </select>\n";
    echo "\n";
    echo "            </div>\n";
    echo "            <div class=\"modal-footer\">\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-confirm waves-effect waves-green btn-flat \">Save</a>\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-cancel waves-effect waves-green btn-flat \">Cancel</a>\n";
    echo "            </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='confirmDeleteModal_template'>\n";
    echo "\n";
    echo "		    <div class=\"modal-content\">\n";
    echo "			    <h4>Are you sure you want to delete <%= type %>?</h4>\n";
    echo "		    </div>\n";
    echo "		    <div class=\"modal-footer\">\n";
    echo "			    <a href=\"#\" onclick=\"<%= onConfirm %>\" class=\" modal-action modal-close waves-effect waves-green btn-flat\">Yes</a>\n";
    echo "                <a href=\"#\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Cancel</a>\n";
    echo "		    </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='deleteByRepeatSchemeModal_template'>\n";
    echo "\n";
    echo "		    <div class=\"modal-content\">\n";
    echo "			    <h5>This entry has a repeat scheme. To permanently delete just this entry select \"DELETE ENTRY\". To permanently delete all entries associated with the repeat scheme select \"DELETE ALL\". </h5>\n";
    echo "		        <p>This action cannot be undone.</p>\n";
    echo "                <select id=\"deleteByRepeatSchemeOptions\">\n";
    echo "                    <option value=\"single\">DELETE ENTRY</option>\n";
    echo "                    <option value=\"all\">DELETE ALL</option>\n";
    echo "                </select>\n";
    echo "		    </div>\n";
    echo "		    <div class=\"modal-footer\">\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-confirm waves-effect waves-green btn-flat \">Confirm </a>\n";
    echo "              <a href=\"#!\" class=\"modal-action modal-close modal-cancel waves-effect waves-green btn-flat \">Cancel</a>\n";
    echo "            </div>\n";
    echo "\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='confirmGridSaveModal_template'>\n";
    echo "\n";
    echo "		    <div class=\"modal-content\">\n";
    echo "			    <h4>You are creating a double-booking.</h4>\n";
    echo "			    <p><%= conflict %></p>\n";
    echo "			    <p><%= contact %></p>\n";
    echo "			    <p><%= cancelOption %></p>\n";
    echo "\n";
    echo "		    </div>\n";
    echo "		    <div class=\"modal-footer\">\n";
    echo "			    <a href=\"\" onclick=\"<%= onConfirm %>\" class=\" modal-action modal-close waves-effect waves-green btn-flat\">Confirm</a>\n";
    echo "			    <!--                    <a href=\"#!\" onclick=\"<%= onCancel %>\" class=\" modal-action modal-close waves-effect waves-green btn-flat\">Cancel</a>-->\n";
    echo "		    </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='pleaseWaitModal_template'>\n";
    echo "\n";
    echo "            <div class=\"modal-content\">\n";
    echo "			    <h4>Loading, please wait... </h4>\n";
    echo "			    <h3></h3>\n";
    echo "		    </div>\n";
    echo "		    <div class=\"modal-footer\">\n";
    echo "		    </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/template' id='confirmSaveModal_template'>\n";
    echo "\n";
    echo "		     <div class=\"modal-content\">\n";
    echo "			    <h4>Are you sure you want to save this <%= type %>?</h4>\n";
    echo "		    </div>\n";
    echo "		    <div class=\"modal-footer\">\n";
    echo "			    <% _.each(actions, function(action) { %>\n";
    echo "			    <% var onClick = action.get(\"onClick\"); %>\n";
    echo "			    <a href=\"\" onclick=\"<%= onClick %>\" class=\" modal-action modal-close waves-effect waves-green btn-flat\"><%= action.get(\"text\") %></a>\n";
    echo "			    <% }); %>\n";
    echo "			    <a href=\"\" class=\" modal-action modal-close waves-effect waves-green btn-flat\">Cancel</a>\n";
    echo "		    </div>\n";
    echo "        \n";
    echo "</script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/jquery-2.1.1.min.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/jqueryui/jquery-ui.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/framework/underscore.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/materialize/js/materialize.min.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/framework/backbone.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/namespace/namespace.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/fullcalendar/moment.min.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/utils/uxUtils.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/init/categorizerInit.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/views/CategorizerView.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/views/CategorizerSectionView.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/views/CategorizerItemView.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/views/CategorizerAddNew.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/models/reifyModel.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/views/ux/Badge.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/src/models/categorizerSortModel.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/select2/select2.js'></script>\n";
    echo "<script type = 'text/javascript' src ='/libs/js/wunderlist/wunderlist.sdk.min.js'></script><link rel='stylesheet' type = 'text/css' href='/view/modules/admin/view/css/admin.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/view/css/app.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/view/css/font-awesome.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/materialize/css/materialize.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='https://fonts.googleapis.com/icon?family=Material+Icons' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/js/backgrid/backgrid.min.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/js/backgrid/backgrid.paginator.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/js/backgrid/theme.blue.min.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/js/jqueryui/jquery-ui.css' media='all' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/libs/js/select2/select2.css' media='screen' />\n";
    echo "<link rel='stylesheet' type = 'text/css' href='/view/css/categorizer.css' media='screen' />\n";
    echo "\n";
    echo "</head>\n";
    echo "\n";
    echo "<body   >\n";
    echo "                <script>\n";
    echo "                    PlantAhead.namespace(\n";
    echo "                        'PlantAhead.InitData',";
    print  '{
        collectionJSON:[
      {
          "id":1,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Function-based didactic access",
         "taskCategoryID":6,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":2,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Virtual system-worthy paradigm",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":4,
         "dueDate":null,
         "userID":16,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":3,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Face to face systematic methodology",
         "taskCategoryID":5,
         "cityID":6,
         "laborEstimate":6,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":4,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Monitored mobile core",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":2,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":5,
         "taskPriorityLevelID":5,
         "completed":0,
         "task":"Inverse cohesive Graphic Interface",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":1,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":6,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Optimized client-driven capability",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":6,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":7,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Horizontal scalable infrastructure",
         "taskCategoryID":5,
         "cityID":6,
         "laborEstimate":8,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":8,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Business-focused maximized frame",
         "taskCategoryID":4,
         "cityID":2,
         "laborEstimate":8,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":9,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Focused reciprocal application",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":6,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":10,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Configurable well-modulated Graphic Interface",
         "taskCategoryID":1,
         "cityID":7,
         "laborEstimate":6,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":11,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Phased bi-directional capability",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":3,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":12,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Virtual user-facing help-desk",
         "taskCategoryID":6,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":13,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Universal bifurcated implementation",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":8,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":14,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Universal high-level interface",
         "taskCategoryID":1,
         "cityID":5,
         "laborEstimate":7,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":15,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Upgradable multimedia infrastructure",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":2,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":16,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Diverse intangible budgetary management",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":4,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":17,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Versatile optimal groupware",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":6,
         "dueDate":null,
         "userID":5,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":18,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Networked optimal emulation",
         "taskCategoryID":6,
         "cityID":4,
         "laborEstimate":2,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":19,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Reactive disintermediate standardization",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":20,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Implemented motivating encoding",
         "taskCategoryID":5,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":21,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Multi-layered 24\/7 hub",
         "taskCategoryID":4,
         "cityID":5,
         "laborEstimate":4,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":22,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Multi-tiered systematic protocol",
         "taskCategoryID":1,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":23,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Object-based responsive synergy",
         "taskCategoryID":7,
         "cityID":2,
         "laborEstimate":8,
         "dueDate":null,
         "userID":21,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":24,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Distributed client-driven ability",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":7,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":25,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Proactive tertiary installation",
         "taskCategoryID":3,
         "cityID":4,
         "laborEstimate":1,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":26,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Robust maximized project",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":27,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Automated 4th generation complexity",
         "taskCategoryID":2,
         "cityID":2,
         "laborEstimate":7,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":28,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Implemented next generation matrix",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":29,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Function-based 6th generation service-desk",
         "taskCategoryID":5,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":6,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":30,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Organized homogeneous concept",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":31,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Decentralized demand-driven model",
         "taskCategoryID":1,
         "cityID":3,
         "laborEstimate":8,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":32,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Grass-roots bandwidth-monitored software",
         "taskCategoryID":5,
         "cityID":4,
         "laborEstimate":3,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":33,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Implemented incremental structure",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":4,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":34,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Inverse motivating archive",
         "taskCategoryID":6,
         "cityID":7,
         "laborEstimate":4,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":35,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Front-line user-facing database",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":6,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":36,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Managed bifurcated open system",
         "taskCategoryID":2,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":37,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Implemented empowering budgetary management",
         "taskCategoryID":1,
         "cityID":4,
         "laborEstimate":8,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":38,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Horizontal stable implementation",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":3,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":39,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Open-source tertiary projection",
         "taskCategoryID":6,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":40,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Triple-buffered intermediate leverage",
         "taskCategoryID":2,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":16,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":41,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Operative coherent groupware",
         "taskCategoryID":4,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":42,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Streamlined executive intranet",
         "taskCategoryID":1,
         "cityID":5,
         "laborEstimate":7,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":43,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Secured context-sensitive middleware",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":44,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Implemented intermediate open architecture",
         "taskCategoryID":2,
         "cityID":4,
         "laborEstimate":6,
         "dueDate":null,
         "userID":12,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":45,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Innovative discrete capability",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":13,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":46,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Synergized secondary initiative",
         "taskCategoryID":1,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":47,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Total executive interface",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":5,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":48,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Business-focused multi-tasking pricing structure",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":1,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":49,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Multi-layered optimal moderator",
         "taskCategoryID":6,
         "cityID":2,
         "laborEstimate":7,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":50,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Cross-group zero tolerance hierarchy",
         "taskCategoryID":4,
         "cityID":3,
         "laborEstimate":6,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":51,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Programmable responsive standardization",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":8,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":52,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Ergonomic radical hub",
         "taskCategoryID":4,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":53,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Universal radical challenge",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":54,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Triple-buffered directional knowledge base",
         "taskCategoryID":5,
         "cityID":5,
         "laborEstimate":3,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":55,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Monitored mission-critical productivity",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":3,
         "dueDate":null,
         "userID":21,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":56,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Operative value-added moratorium",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":6,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":57,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Assimilated dedicated time-frame",
         "taskCategoryID":7,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":58,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Switchable motivating hierarchy",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":6,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":59,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Organic bifurcated open architecture",
         "taskCategoryID":2,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":60,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Down-sized user-facing solution",
         "taskCategoryID":6,
         "cityID":5,
         "laborEstimate":4,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":61,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Polarised hybrid artificial intelligence",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":3,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":62,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Self-enabling zero tolerance matrices",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":3,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":63,
         "taskPriorityLevelID":5,
         "completed":0,
         "task":"Total transitional concept",
         "taskCategoryID":2,
         "cityID":6,
         "laborEstimate":5,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":64,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"User-centric heuristic workforce",
         "taskCategoryID":6,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":21,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":65,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Exclusive foreground encoding",
         "taskCategoryID":3,
         "cityID":6,
         "laborEstimate":3,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":66,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Diverse well-modulated architecture",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":1,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":67,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Object-based high-level middleware",
         "taskCategoryID":4,
         "cityID":5,
         "laborEstimate":3,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":68,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Synergized human-resource middleware",
         "taskCategoryID":4,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":69,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Streamlined hybrid system engine",
         "taskCategoryID":7,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":70,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Programmable tangible initiative",
         "taskCategoryID":2,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":71,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Reactive transitional hub",
         "taskCategoryID":1,
         "cityID":3,
         "laborEstimate":7,
         "dueDate":null,
         "userID":6,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":72,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"User-friendly stable projection",
         "taskCategoryID":7,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":73,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Programmable modular moratorium",
         "taskCategoryID":2,
         "cityID":1,
         "laborEstimate":4,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":74,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Advanced incremental moderator",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":75,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Synchronised full-range complexity",
         "taskCategoryID":2,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":20,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":76,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Re-contextualized multi-state algorithm",
         "taskCategoryID":1,
         "cityID":1,
         "laborEstimate":3,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":77,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Fundamental 6th generation adapter",
         "taskCategoryID":7,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":78,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Open-source optimizing pricing structure",
         "taskCategoryID":2,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":6,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":79,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Grass-roots asynchronous framework",
         "taskCategoryID":3,
         "cityID":5,
         "laborEstimate":2,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":80,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Stand-alone radical complexity",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":7,
         "dueDate":null,
         "userID":26,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":81,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Synchronised non-volatile success",
         "taskCategoryID":7,
         "cityID":2,
         "laborEstimate":3,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":82,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Phased national system engine",
         "taskCategoryID":7,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":83,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Upgradable multimedia parallelism",
         "taskCategoryID":6,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":84,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Optimized context-sensitive paradigm",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":5,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":85,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Vision-oriented discrete forecast",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":86,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Implemented regional secured line",
         "taskCategoryID":2,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":87,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Reduced fresh-thinking Graphical User Interface",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":88,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Adaptive contextually-based superstructure",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":4,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":89,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Re-engineered 24 hour system engine",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":4,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":90,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"User-centric systematic encryption",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":8,
         "dueDate":null,
         "userID":26,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":91,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Object-based grid-enabled infrastructure",
         "taskCategoryID":4,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":92,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Distributed coherent strategy",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":93,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Centralized coherent functionalities",
         "taskCategoryID":5,
         "cityID":6,
         "laborEstimate":4,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":94,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Future-proofed incremental neural-net",
         "taskCategoryID":4,
         "cityID":7,
         "laborEstimate":2,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":95,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Optimized homogeneous task-force",
         "taskCategoryID":4,
         "cityID":1,
         "laborEstimate":3,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":96,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Sharable explicit monitoring",
         "taskCategoryID":1,
         "cityID":7,
         "laborEstimate":2,
         "dueDate":null,
         "userID":13,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":97,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Inverse tangible initiative",
         "taskCategoryID":4,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":98,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Reduced systematic solution",
         "taskCategoryID":6,
         "cityID":7,
         "laborEstimate":3,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":99,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Progressive optimizing solution",
         "taskCategoryID":7,
         "cityID":2,
         "laborEstimate":4,
         "dueDate":null,
         "userID":20,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":100,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Front-line cohesive service-desk",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":2,
         "dueDate":null,
         "userID":13,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":101,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Re-contextualized local policy",
         "taskCategoryID":1,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":5,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":102,
         "taskPriorityLevelID":5,
         "completed":1,
         "task":"Cloned solution-oriented website",
         "taskCategoryID":6,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":103,
         "taskPriorityLevelID":4,
         "completed":1,
         "task":"Organic regional open architecture",
         "taskCategoryID":3,
         "cityID":4,
         "laborEstimate":3,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":104,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Self-enabling secondary infrastructure",
         "taskCategoryID":5,
         "cityID":4,
         "laborEstimate":4,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":105,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Integrated object-oriented database",
         "taskCategoryID":1,
         "cityID":1,
         "laborEstimate":3,
         "dueDate":null,
         "userID":2,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":106,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Operative user-facing local area network",
         "taskCategoryID":3,
         "cityID":5,
         "laborEstimate":4,
         "dueDate":null,
         "userID":13,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":107,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Down-sized directional adapter",
         "taskCategoryID":4,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":108,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Team-oriented global application",
         "taskCategoryID":6,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":109,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Re-contextualized heuristic hardware",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":6,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":110,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Networked background intranet",
         "taskCategoryID":2,
         "cityID":6,
         "laborEstimate":2,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":111,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Decentralized static protocol",
         "taskCategoryID":1,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":112,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Extended fresh-thinking software",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":2,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":113,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Streamlined analyzing standardization",
         "taskCategoryID":2,
         "cityID":3,
         "laborEstimate":1,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":114,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Fully-configurable optimal initiative",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":6,
         "dueDate":null,
         "userID":17,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":115,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Multi-tiered dedicated task-force",
         "taskCategoryID":1,
         "cityID":4,
         "laborEstimate":1,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":116,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Decentralized non-volatile service-desk",
         "taskCategoryID":3,
         "cityID":2,
         "laborEstimate":3,
         "dueDate":null,
         "userID":20,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":117,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Public-key grid-enabled local area network",
         "taskCategoryID":6,
         "cityID":4,
         "laborEstimate":6,
         "dueDate":null,
         "userID":26,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":118,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Exclusive grid-enabled structure",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":119,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Enhanced multi-tasking model",
         "taskCategoryID":1,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":120,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Re-engineered modular encoding",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":3,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":121,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Phased empowering groupware",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":122,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Advanced user-facing moratorium",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":7,
         "dueDate":null,
         "userID":12,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":123,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Networked secondary structure",
         "taskCategoryID":4,
         "cityID":2,
         "laborEstimate":8,
         "dueDate":null,
         "userID":2,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":124,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Grass-roots systematic website",
         "taskCategoryID":3,
         "cityID":6,
         "laborEstimate":4,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":125,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Multi-lateral cohesive knowledge user",
         "taskCategoryID":5,
         "cityID":2,
         "laborEstimate":2,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":126,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Upgradable cohesive functionalities",
         "taskCategoryID":1,
         "cityID":5,
         "laborEstimate":6,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":127,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Advanced context-sensitive encryption",
         "taskCategoryID":3,
         "cityID":6,
         "laborEstimate":6,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":128,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Optional optimizing budgetary management",
         "taskCategoryID":5,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":2,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":129,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Quality-focused tangible collaboration",
         "taskCategoryID":2,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":130,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Intuitive optimizing superstructure",
         "taskCategoryID":6,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":131,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Expanded regional firmware",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":2,
         "dueDate":null,
         "userID":10,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":132,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Programmable web-enabled instruction set",
         "taskCategoryID":7,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":133,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Diverse multi-tasking Graphic Interface",
         "taskCategoryID":4,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":134,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Enhanced scalable implementation",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":28,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":135,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Reverse-engineered 24\/7 capacity",
         "taskCategoryID":4,
         "cityID":7,
         "laborEstimate":1,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":136,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Profit-focused eco-centric function",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":137,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Future-proofed multi-tasking Graphical User Interface",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":5,
         "dueDate":null,
         "userID":16,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":138,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Synergistic bifurcated migration",
         "taskCategoryID":3,
         "cityID":4,
         "laborEstimate":2,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":139,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Optional interactive productivity",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":140,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Universal logistical artificial intelligence",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":141,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Devolved mission-critical structure",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":142,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Compatible value-added middleware",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":12,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":143,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Polarised encompassing local area network",
         "taskCategoryID":2,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":144,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Seamless didactic challenge",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":1,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":145,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Universal composite frame",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":5,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":146,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Intuitive dedicated local area network",
         "taskCategoryID":2,
         "cityID":1,
         "laborEstimate":5,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":147,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Exclusive fresh-thinking project",
         "taskCategoryID":7,
         "cityID":3,
         "laborEstimate":3,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":148,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Customer-focused clear-thinking productivity",
         "taskCategoryID":6,
         "cityID":2,
         "laborEstimate":7,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":149,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Focused static matrices",
         "taskCategoryID":4,
         "cityID":2,
         "laborEstimate":3,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":150,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Versatile uniform encoding",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":8,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":151,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Sharable incremental local area network",
         "taskCategoryID":7,
         "cityID":1,
         "laborEstimate":7,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":152,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Self-enabling asynchronous flexibility",
         "taskCategoryID":1,
         "cityID":2,
         "laborEstimate":2,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":153,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Operative real-time function",
         "taskCategoryID":5,
         "cityID":6,
         "laborEstimate":5,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":154,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Versatile 24 hour challenge",
         "taskCategoryID":2,
         "cityID":1,
         "laborEstimate":3,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":155,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Pre-emptive real-time pricing structure",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":8,
         "dueDate":null,
         "userID":2,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":156,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Cross-group zero tolerance protocol",
         "taskCategoryID":4,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":157,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Profound motivating Graphical User Interface",
         "taskCategoryID":6,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":158,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Streamlined 3rd generation time-frame",
         "taskCategoryID":5,
         "cityID":4,
         "laborEstimate":5,
         "dueDate":null,
         "userID":6,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":159,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Vision-oriented hybrid strategy",
         "taskCategoryID":5,
         "cityID":2,
         "laborEstimate":2,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":160,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Devolved discrete hub",
         "taskCategoryID":6,
         "cityID":4,
         "laborEstimate":8,
         "dueDate":null,
         "userID":5,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":161,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Ergonomic foreground function",
         "taskCategoryID":4,
         "cityID":6,
         "laborEstimate":3,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":5,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":162,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Ameliorated even-keeled core",
         "taskCategoryID":3,
         "cityID":3,
         "laborEstimate":6,
         "dueDate":null,
         "userID":15,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":163,
         "taskPriorityLevelID":4,
         "completed":0,
         "task":"Enhanced optimal function",
         "taskCategoryID":2,
         "cityID":4,
         "laborEstimate":7,
         "dueDate":null,
         "userID":18,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":164,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Reduced non-volatile budgetary management",
         "taskCategoryID":7,
         "cityID":5,
         "laborEstimate":6,
         "dueDate":null,
         "userID":16,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":165,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Centralized incremental task-force",
         "taskCategoryID":3,
         "cityID":5,
         "laborEstimate":7,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":3,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":166,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Streamlined dynamic leverage",
         "taskCategoryID":5,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":13,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":167,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Re-engineered actuating contingency",
         "taskCategoryID":4,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":3,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":168,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Enterprise-wide local alliance",
         "taskCategoryID":3,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":6,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":169,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Automated intermediate product",
         "taskCategoryID":2,
         "cityID":3,
         "laborEstimate":5,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":170,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Object-based user-facing extranet",
         "taskCategoryID":3,
         "cityID":2,
         "laborEstimate":7,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":171,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Versatile 5th generation middleware",
         "taskCategoryID":7,
         "cityID":7,
         "laborEstimate":4,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":172,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Customizable context-sensitive algorithm",
         "taskCategoryID":3,
         "cityID":1,
         "laborEstimate":6,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":11,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":173,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Devolved upward-trending alliance",
         "taskCategoryID":1,
         "cityID":2,
         "laborEstimate":1,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":174,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Synergized well-modulated strategy",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":2,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":175,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Automated full-range challenge",
         "taskCategoryID":2,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":26,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":176,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Function-based asymmetric model",
         "taskCategoryID":1,
         "cityID":7,
         "laborEstimate":8,
         "dueDate":null,
         "userID":19,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":177,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Assimilated regional data-warehouse",
         "taskCategoryID":4,
         "cityID":5,
         "laborEstimate":1,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":178,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Customer-focused client-driven hub",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":2,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":179,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Centralized local pricing structure",
         "taskCategoryID":3,
         "cityID":6,
         "laborEstimate":7,
         "dueDate":null,
         "userID":27,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":180,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Team-oriented 24\/7 support",
         "taskCategoryID":3,
         "cityID":3,
         "laborEstimate":5,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":181,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Universal methodical project",
         "taskCategoryID":4,
         "cityID":7,
         "laborEstimate":3,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":182,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Future-proofed modular contingency",
         "taskCategoryID":6,
         "cityID":1,
         "laborEstimate":8,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":183,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Implemented encompassing success",
         "taskCategoryID":2,
         "cityID":6,
         "laborEstimate":5,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":184,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Quality-focused homogeneous middleware",
         "taskCategoryID":6,
         "cityID":6,
         "laborEstimate":2,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":185,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Optional value-added firmware",
         "taskCategoryID":7,
         "cityID":3,
         "laborEstimate":8,
         "dueDate":null,
         "userID":26,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":2,
         "notes":null,
         "farmProjectID":6,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":186,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Open-source tertiary extranet",
         "taskCategoryID":6,
         "cityID":5,
         "laborEstimate":4,
         "dueDate":null,
         "userID":9,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":187,
         "taskPriorityLevelID":5,
         "completed":1,
         "task":"Synergized clear-thinking knowledge base",
         "taskCategoryID":6,
         "cityID":1,
         "laborEstimate":3,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":1,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":188,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Optional radical application",
         "taskCategoryID":6,
         "cityID":3,
         "laborEstimate":4,
         "dueDate":null,
         "userID":6,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":189,
         "taskPriorityLevelID":2,
         "completed":null,
         "task":"Multi-layered radical attitude",
         "taskCategoryID":5,
         "cityID":6,
         "laborEstimate":1,
         "dueDate":null,
         "userID":16,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":190,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Profit-focused next generation Graphical User Interface",
         "taskCategoryID":5,
         "cityID":7,
         "laborEstimate":7,
         "dueDate":null,
         "userID":5,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":1,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":191,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Innovative zero administration architecture",
         "taskCategoryID":2,
         "cityID":3,
         "laborEstimate":2,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":8,
         "notes":null,
         "farmProjectID":4,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":192,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Re-contextualized national instruction set",
         "taskCategoryID":3,
         "cityID":7,
         "laborEstimate":4,
         "dueDate":null,
         "userID":4,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":7,
         "notes":null,
         "farmProjectID":2,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":193,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Team-oriented global contingency",
         "taskCategoryID":2,
         "cityID":5,
         "laborEstimate":5,
         "dueDate":null,
         "userID":7,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":9,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":194,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Total 5th generation protocol",
         "taskCategoryID":1,
         "cityID":2,
         "laborEstimate":5,
         "dueDate":null,
         "userID":24,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":4,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":195,
         "taskPriorityLevelID":4,
         "completed":null,
         "task":"Polarised secondary parallelism",
         "taskCategoryID":5,
         "cityID":3,
         "laborEstimate":3,
         "dueDate":null,
         "userID":14,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":10,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":196,
         "taskPriorityLevelID":1,
         "completed":null,
         "task":"Multi-lateral explicit leverage",
         "taskCategoryID":1,
         "cityID":2,
         "laborEstimate":6,
         "dueDate":null,
         "userID":25,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":10,
         "notes":null,
         "farmProjectID":8,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":197,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Multi-lateral system-worthy moderator",
         "taskCategoryID":3,
         "cityID":1,
         "laborEstimate":6,
         "dueDate":null,
         "userID":1,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":198,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Profound eco-centric capacity",
         "taskCategoryID":3,
         "cityID":5,
         "laborEstimate":4,
         "dueDate":null,
         "userID":11,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":199,
         "taskPriorityLevelID":3,
         "completed":null,
         "task":"Synergized scalable secured line",
         "taskCategoryID":1,
         "cityID":1,
         "laborEstimate":2,
         "dueDate":null,
         "userID":22,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":11,
         "notes":null,
         "farmProjectID":7,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      },
      {
          "id":200,
         "taskPriorityLevelID":5,
         "completed":null,
         "task":"Open-architected 5th generation matrix",
         "taskCategoryID":3,
         "cityID":1,
         "laborEstimate":6,
         "dueDate":null,
         "userID":23,
         "timestamp":"2017-01-15 02:24:51",
         "farmDepartmentID":5,
         "notes":null,
         "farmProjectID":9,
         "automationTask":null,
         "start":null,
         "deviceID":null,
         "duration":null
      }
   ],
   tableMeta:{
        "tableComments":"{\"title\":\"Big Corp Co.\", \"description\":\"Big Corp Co.\"}",
      "tablePrimaryKey":"id",
      "fieldsMeta":[
         {
             "name":"id",
            "type":"integer",
            "comment":{
             "display":"none"
            }
         },
         {
             "name":"taskPriorityLevelID",
            "type":"select2",
            "comment":{
             "alias":"Priority",
               "badgeColor":"red",
               "badgeIcon":"error"
            }
         },
         {
             "name":"completed",
            "type":"boolean",
            "comment":{

         }
         },
         {
             "name":"task",
            "type":"string",
            "comment":{
             "css":"text-align:left; font-weight:bold;"
            }
         },
         {
             "name":"taskCategoryID",
            "type":"select2",
            "comment":{
             "alias":"Task Type",
               "insertable":"true",
               "badgeColor":"brown",
               "badgeIcon":"build"
            }
         },
         {
             "name":"cityID",
            "type":"select2",
            "comment":{
             "insertable":"true",
               "badgeColor":"red",
               "badgeIcon":"place"
            }
         },
         {
             "decimals":2,
            "name":"laborEstimate",
            "type":"number",
            "comment":{
             "alias":"Labor Estimate (hrs.)",
               "badgeColor":"orange",
               "badgeIcon":"query_builder"
            }
         },
         {
             "name":"dueDate",
            "type":"date",
            "comment":{
             "badgeColor":"red",
               "badgeIcon":"today"
            }
         },
         {
             "name":"userID",
            "type":"select2",
            "comment":{
             "alias":"Assignee",
               "insertable":"true",
               "badgeColor":"blue",
               "badgeIcon":"perm_identity"
            }
         },
         {
             "name":"timestamp",
            "type":"timestamp",
            "comment":{
             "alias":"Created",
               "badgeColor":"green",
               "badgeIcon":"today"
            }
         },
         {
             "name":"farmDepartmentID",
            "type":"select2",
            "comment":{
             "alias":"Department",
               "badgeColor":"black",
               "badgeIcon":"location_city"
            }
         },
         {
             "name":"notes",
            "type":"string",
            "comment":{

         }
         },
         {
             "name":"farmProjectID",
            "type":"select2",
            "comment":{
             "class":"hidden reveal farmDepartmentReveal",
               "alias":"Project",
               "badgeColor":"deep-orange",
               "badgeIcon":"extension"
            }
         },
         {
             "name":"automationTask",
            "type":"boolean",
            "comment":{

         }
         },
         {
             "name":"start",
            "type":"datetime",
            "comment":{

         }
         },
         {
             "name":"deviceID",
            "type":"select2",
            "comment":{

         }
         },
         {
             "decimals":2,
            "name":"duration",
            "type":"number",
            "comment":{

         }
         }
      ],
      "fkRelations":{
            "column_name":"cityID",
         "foreign_db":"plantahead",
         "foreign_table":"city",
         "foreign_column":"id"
      },
      "tableName":"corporate"
   },
   fkCollections:{
        city:[
         {
             "id":1,
            "cityName":"Tucson, AZ"
         },
         {
             "id":2,
            "cityName":"Wichita, KS"
         },
         {
             "id":3,
            "cityName":"Pittsburgh, PA"
         },
         {
             "id":4,
            "cityName":"Maui, HA"
         },
         {
             "id":5,
            "cityName":"New York, NY"
         },
         {
             "id":6,
            "cityName":"Los Angeles, CA"
         },
         {
             "id":7,
            "cityName":"San Francisco, CA"
         }
      ],
      device:[
         {
             "id":1,
            "deviceName":"Dishwasher 01"
         },
         {
             "id":2,
            "deviceName":"Dishwasher 02"
         },
         {
             "id":3,
            "deviceName":"Garden Sprinkler N1"
         },
         {
             "id":4,
            "deviceName":"Garden Sprinkler S1"
         },
         {
             "id":5,
            "deviceName":"N Deep Green Sprinkler "
         }
      ],
      taskCategory:[
         {
             "id":1,
            "taskCategoryName":"Programming"
         },
         {
             "id":2,
            "taskCategoryName":"Video Editing"
         },
         {
             "id":3,
            "taskCategoryName":"Audio Engineering"
         },
         {
             "id":4,
            "taskCategoryName":"Graphic Design"
         },
         {
             "id":5,
            "taskCategoryName":"Managerial Training"
         },
         {
             "id":6,
            "taskCategoryName":"Administration"
         },
         {
             "id":7,
            "taskCategoryName":"Office Clerical"
         },
         {
             "id":9,
            "taskCategoryName":"Compost"
         },
         {
             "id":10,
            "taskCategoryName":"Planting"
         },
         {
             "id":11,
            "taskCategoryName":"Acquisitions"
         },
         {
             "id":14,
            "taskCategoryName":"Bed Preparation"
         },
         {
             "id":19,
            "taskCategoryName":"Potting Soil Preparation"
         },
         {
             "id":20,
            "taskCategoryName":"Weed Whipping"
         },
         {
             "id":21,
            "taskCategoryName":"Harvest"
         },
         {
             "id":25,
            "taskCategoryName":"Farm Equipment Maint."
         },
         {
             "id":27,
            "taskCategoryName":"Food Processing"
         },
         {
             "id":31,
            "taskCategoryName":"Grain Processing"
         },
         {
             "id":32,
            "taskCategoryName":"Hay Operation"
         },
         {
             "id":38,
            "taskCategoryName":"R & D \/ New Projects"
         },
         {
             "id":40,
            "taskCategoryName":"Field Maintenance"
         },
         {
             "id":41,
            "taskCategoryName":"Planting & Soil Prep - Field"
         },
         {
             "id":42,
            "taskCategoryName":"Irrigation - Flood"
         },
         {
             "id":43,
            "taskCategoryName":"Tree Work, Brush Clearing"
         },
         {
             "id":44,
            "taskCategoryName":"Fencing"
         },
         {
             "id":46,
            "taskCategoryName":"Fruit & Berries"
         },
         {
             "id":47,
            "taskCategoryName":"Projects Supervision"
         },
         {
             "id":48,
            "taskCategoryName":"Reports, Records, & Systems Analysis"
         },
         {
             "id":49,
            "taskCategoryName":"Bordering"
         },
         {
             "id":50,
            "taskCategoryName":"Scheduling & Personnel"
         },
         {
             "id":51,
            "taskCategoryName":"Propagation"
         },
         {
             "id":52,
            "taskCategoryName":"Infrastructure Maintenance"
         },
         {
             "id":54,
            "taskCategoryName":"Corral Cleaning\/ Compost"
         },
         {
             "id":55,
            "taskCategoryName":"Corral & Trough Maintenance"
         },
         {
             "id":56,
            "taskCategoryName":"Animal Medical"
         },
         {
             "id":57,
            "taskCategoryName":"Breeding, Incubating, Hatching"
         },
         {
             "id":58,
            "taskCategoryName":"Daily Animal Routines"
         },
         {
             "id":59,
            "taskCategoryName":"Goats & Llamas"
         },
         {
             "id":60,
            "taskCategoryName":"Poultry"
         },
         {
             "id":61,
            "taskCategoryName":"Cows"
         },
         {
             "id":63,
            "taskCategoryName":"Emus & Pig"
         },
         {
             "id":65,
            "taskCategoryName":"Routine Tasks"
         },
         {
             "id":67,
            "taskCategoryName":"Spraying"
         },
         {
             "id":68,
            "taskCategoryName":"Meetings"
         },
         {
             "id":69,
            "taskCategoryName":"Office & Admin"
         },
         {
             "id":70,
            "taskCategoryName":"EM"
         },
         {
             "id":71,
            "taskCategoryName":"Milking Parlor"
         },
         {
             "id":72,
            "taskCategoryName":"Routine Planning"
         },
         {
             "id":73,
            "taskCategoryName":"Organic Certification"
         },
         {
             "id":75,
            "taskCategoryName":"farmTask Grid"
         },
         {
             "id":77,
            "taskCategoryName":"Plastic Pulling"
         },
         {
             "id":78,
            "taskCategoryName":"fen"
         }
      ],
      user:[
         {
             "id":1,
            "userName":"Me",
            "userImg":"http:\/\/avalongardens.org\/view\/images\/graphics\/seminar\/taliseen.jpg",
            "headerImg":"",
            "email":"taliseen@avalongardens.org",
            "phone":5208600617,
            "firstName":null,
            "lastName":null,
            "dob":"1985-03-16"
         },
         {
             "id":2,
            "userName":"CaSeri",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":3,
            "userName":"Austein",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":4,
            "userName":"Jacqueline",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":5,
            "userName":"Denae",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":6,
            "userName":"Duke",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":7,
            "userName":"Rossana",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":8,
            "userName":"Dee",
            "userImg":null,
            "headerImg":null,
            "email":"caseri@globalchange.media",
            "phone":null,
            "firstName":"CaSeri",
            "lastName":"Bajor",
            "dob":null
         },
         {
             "id":9,
            "userName":"Ching",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":10,
            "userName":"Felipa",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":11,
            "userName":"Lietitia",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":12,
            "userName":"Loyce",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":13,
            "userName":"Sadye",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":14,
            "userName":"Jerry",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":15,
            "userName":"Angela",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":16,
            "userName":"Barthalomew",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":17,
            "userName":"Lucy",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":18,
            "userName":"Michael",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":19,
            "userName":"Rodriguez",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":20,
            "userName":"Johanna",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":21,
            "userName":"Carmen",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":22,
            "userName":"Ronald",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":23,
            "userName":"Lidia",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":24,
            "userName":"Alexis",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":25,
            "userName":"Dylan",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":26,
            "userName":"Darrick",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":27,
            "userName":"Eliana",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":28,
            "userName":"Veta",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":30,
            "userName":"Marcella",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":31,
            "userName":"Ireland",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":33,
            "userName":"Xesus",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":34,
            "userName":"Frankie",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":35,
            "userName":"Ronni",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":36,
            "userName":"PiSeen",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":37,
            "userName":"Shalon",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":38,
            "userName":"PiSeen",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":39,
            "userName":"Tarus",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":40,
            "userName":"Keri",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":41,
            "userName":"Savijaveh",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":42,
            "userName":"Nicol",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":43,
            "userName":"Fred",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":45,
            "userName":"Selendra",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":46,
            "userName":"Aslen",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":47,
            "userName":"Rigoberto",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         },
         {
             "id":48,
            "userName":"TaliSeen",
            "userImg":null,
            "headerImg":null,
            "email":null,
            "phone":null,
            "firstName":null,
            "lastName":null,
            "dob":null
         }
      ],
      taskPriorityLevel:[
         {
             "id":1,
            "taskPriorityLevelName":1
         },
         {
             "id":2,
            "taskPriorityLevelName":2
         },
         {
             "id":3,
            "taskPriorityLevelName":3
         },
         {
             "id":4,
            "taskPriorityLevelName":4
         },
         {
             "id":5,
            "taskPriorityLevelName":5
         }
      ],
      farmDepartment:[
         {
             "id":1,
            "farmDepartmentName":"Development"
         },
         {
             "id":2,
            "farmDepartmentName":"Business Dev."
         },
         {
             "id":3,
            "farmDepartmentName":"Operations"
         },
         {
             "id":4,
            "farmDepartmentName":"Accounting"
         },
         {
             "id":5,
            "farmDepartmentName":"Logistics"
         },
         {
             "id":6,
            "farmDepartmentName":"Human Resources"
         },
         {
             "id":7,
            "farmDepartmentName":"Branding"
         },
         {
             "id":8,
            "farmDepartmentName":"Social Media"
         },
         {
             "id":9,
            "farmDepartmentName":"Marketing"
         },
         {
             "id":10,
            "farmDepartmentName":"Systems Administration"
         },
         {
             "id":11,
            "farmDepartmentName":"Legal"
         },
         {
             "id":12,
            "farmDepartmentName":"Seed Saving"
         },
         {
             "id":13,
            "farmDepartmentName":"Food Processing"
         },
         {
             "id":16,
            "farmDepartmentName":"Lower Garden"
         },
         {
             "id":17,
            "farmDepartmentName":"Vegetables"
         },
         {
             "id":21,
            "farmDepartmentName":"Avalon Gardens Products"
         },
         {
             "id":22,
            "farmDepartmentName":"Hunting & Predator Control"
         },
         {
             "id":23,
            "farmDepartmentName":"Administration"
         },
         {
             "id":24,
            "farmDepartmentName":"Other"
         },
         {
             "id":25,
            "farmDepartmentName":"Bees"
         },
         {
             "id":26,
            "farmDepartmentName":"Creamery"
         }
      ],
      farmProject:[
         {
             "id":1,
            "farmProjectName":"Harsh Tombstone",
            "farmDepartmentID":11
         },
         {
             "id":2,
            "farmProjectName":"Wild Dinosaur",
            "farmDepartmentID":1
         },
         {
             "id":3,
            "farmProjectName":"Dreadful Flannel",
            "farmDepartmentID":11
         },
         {
             "id":4,
            "farmProjectName":"Disgarded Venom",
            "farmDepartmentID":11
         },
         {
             "id":5,
            "farmProjectName":"Third Moon",
            "farmDepartmentID":3
         },
         {
             "id":6,
            "farmProjectName":"Galaxy Blue",
            "farmDepartmentID":11
         },
         {
             "id":7,
            "farmProjectName":"Intensive Toothbrush",
            "farmDepartmentID":3
         },
         {
             "id":8,
            "farmProjectName":"Ivory Winter",
            "farmDepartmentID":11
         },
         {
             "id":9,
            "farmProjectName":"Wild Dinosaur",
            "farmDepartmentID":1
         },
         {
             "id":10,
            "farmProjectName":"Moving Monkey",
            "farmDepartmentID":3
         },
         {
             "id":11,
            "farmProjectName":"Poultry Perimeter",
            "farmDepartmentID":2
         },
         {
             "id":12,
            "farmProjectName":"Hands in the Soil - Herbs",
            "farmDepartmentID":9
         },
         {
             "id":13,
            "farmProjectName":"Genetic Improvement",
            "farmDepartmentID":2
         },
         {
             "id":14,
            "farmProjectName":"Poultry Perimeter Fence: Adobe\/FF",
            "farmDepartmentID":2
         },
         {
             "id":15,
            "farmProjectName":"Autumn 2016 Planting",
            "farmDepartmentID":3
         },
         {
             "id":16,
            "farmProjectName":"Grain\/Seed Storage Maintenance",
            "farmDepartmentID":11
         },
         {
             "id":17,
            "farmProjectName":"RFF s",
            "farmDepartmentID":11
         },
         {
             "id":18,
            "farmProjectName":"Flour & Grain Distribution",
            "farmDepartmentID":11
         },
         {
             "id":19,
            "farmProjectName":"Protocol",
            "farmDepartmentID":11
         },
         {
             "id":20,
            "farmProjectName":"Seed Vault",
            "farmDepartmentID":12
         },
         {
             "id":21,
            "farmProjectName":"Seed Isolation Tents",
            "farmDepartmentID":12
         },
         {
             "id":22,
            "farmProjectName":"North 3 Planting",
            "farmDepartmentID":12
         },
         {
             "id":23,
            "farmProjectName":"Planting Patience Home Seed Area",
            "farmDepartmentID":12
         },
         {
             "id":24,
            "farmProjectName":"Seed Inventory",
            "farmDepartmentID":12
         },
         {
             "id":25,
            "farmProjectName":"2016-17 Seed Plan",
            "farmDepartmentID":12
         },
         {
             "id":26,
            "farmProjectName":"5-7 Year Seed Plan",
            "farmDepartmentID":12
         },
         {
             "id":28,
            "farmProjectName":"Metal Work",
            "farmDepartmentID":11
         }
      ],

   },

}';
    echo ");\n";

    echo "                </script>\n";
echo "            \n";
echo "        <div id=\"appView_container\" class=\"container\"></div>\n";
echo "					<script>\n";
echo "				$( document ).ready(function()\n";
echo "				{\n";
echo "					initCategorizerView('corporate') ;\n";
echo "\n";
echo "                });\n";
echo "			</script>\n";
echo "\n";
echo "		\n";
echo "</body>\n";
echo "\n";
echo "</html>\n";
echo "\n";
});
$app->run();
