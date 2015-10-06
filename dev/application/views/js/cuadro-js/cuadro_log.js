/**
 * Created by amalesh on 2/3/15.
 */

var cuadroLog = {
    logMethod: function (methodName, perams, peramValuess){
        if (cuadroGlobals.loggingEnable) {
            console.log("Method Name: " + methodName);
            var subString = perams.length > 1 ? 's are: ' : ' is: ';
            console.log("Argument" + subString);
            console.log(perams);
            subString = peramValuess.length > 1 ? 's are: ' : ' is: ';
            console.log("Arguments' Value" + subString);
            console.log(peramValuess);
        }
    },

    getParamNames: function (func) {
        var STRIP_COMMENTS = /((\/\/.*$)|(\/\*[\s\S]*?\*\/))/mg;
        var ARGUMENT_NAMES = /([^\s,]+)/g;
        var fnStr = func.toString().replace(STRIP_COMMENTS, '');
        var result = fnStr.slice(fnStr.indexOf('(')+1, fnStr.indexOf(')')).match(ARGUMENT_NAMES);
        if(result === null)
            result = [];
        return result;
    }
}
