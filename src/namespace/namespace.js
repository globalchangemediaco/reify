var PlantAhead = PlantAhead || {};

/**
 * This function generates a namespaced path for WHATEVER string you enter (starting with PlantAhead).
 *
 * @param nameSpace     {string}  generated namespace name
 * @param constructor   {function, model, object}   Whatever you register to the namespace
 * @returns {PlantAhead|*|{}}
 */
PlantAhead.namespace = function (nameSpace, constructor) {
    var hierarchy = nameSpace.split('.'),
        parent = PlantAhead, i, len;

    // strip redundant leading global
    if (hierarchy[0] === "PlantAhead") { hierarchy = hierarchy.slice(1); }

    for (i = 0, len = hierarchy.length; i < len; i += 1) {

        // create a property if it doesn't exist
        if (typeof parent[hierarchy[i]] === "undefined") {
            parent[hierarchy[i]] = (i !== (len - 1) || constructor === undefined)
                ? {}
                : constructor;
        }
        parent = parent[hierarchy[i]];
    }

    return parent;
};