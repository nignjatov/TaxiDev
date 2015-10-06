<?php
/** Common methods.
 * Author: Amalesh Debnath
 * EmailID: amalesh.debnath@gmail.com
 * Version 1.0
 */
if (strcmp(config_item('environment'),'dev') == 0) {
    echo '<script type="text/javascript" src="' . base_url() .'application/views/js/cuadro-js/cuadro_log.js"></script>';
}
?>

<script type="text/javascript">
    var cuadroGlobals = {
        loggingEnable: <?php echo strcmp(config_item('environment'),'dev') == 0 ? 'true' : 'false'?>,
        methodCanRun: true,
        showCallingMethod: <?php echo strcmp(config_item('environment'),'prod') == 0 ? 0 : 1;?>
    }

    var globalStaticData = {
        carType: ["Wagon", "Sedan", "Maxi", "4-Wheel Drive"],
        carStyle: ["Luxury", "Executive", "Prestige"],
        carManufacturer: ["Ford", "Toyota", "Chevrolet", "Commodore"],
        fuelType: ["LPG", "Petrol", "Diesel"]
    }

    var cuadroCommonMethods = {
        getItemID: function (itemString) {
            var temp = itemString.split('td_item_id');
            return temp[1];
        },
        htmlentities: function (string, quote_style, charset, double_encode) {
            quote_style = "ENT_QUOTES";
            var hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style),
                symbol = '';
            string = string == null ? '' : string + '';

            if (!hash_map) {
                return false;
            }

            if (quote_style && quote_style === 'ENT_QUOTES') {
                hash_map["'"] = '&#039;';
            }

            if ( !! double_encode || double_encode == null) {
                for (symbol in hash_map) {
                    if (hash_map.hasOwnProperty(symbol)) {
                        string = string.split(symbol)
                            .join(hash_map[symbol]);
                    }
                }
            } else {
                string = string.replace(/([\s\S]*?)(&(?:#\d+|#x[\da-f]+|[a-zA-Z][\da-z]*);|$)/g, function(ignore, text, entity) {
                    for (symbol in hash_map) {
                        if (hash_map.hasOwnProperty(symbol)) {
                            text = text.split(symbol)
                                .join(hash_map[symbol]);
                        }
                    }

                    return text + entity;
                });
            }

            return string;
        },
        get_html_translation_table: function (table, quote_style) {
            var entities = {},
                hash_map = {},
                decimal;
            var constMappingTable = {},
                constMappingQuoteStyle = {};
            var useTable = {},
                useQuoteStyle = {};

            // Translate arguments
            constMappingTable[0] = 'HTML_SPECIALCHARS';
            constMappingTable[1] = 'HTML_ENTITIES';
            constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
            constMappingQuoteStyle[2] = 'ENT_COMPAT';
            constMappingQuoteStyle[3] = 'ENT_QUOTES';

            useTable = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';
            useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() :
                'ENT_COMPAT';

            if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
                throw new Error('Table: ' + useTable + ' not supported');
                // return false;
            }

            entities['38'] = '&amp;';
            if (useTable === 'HTML_ENTITIES') {
                entities['160'] = '&nbsp;';
                entities['161'] = '&iexcl;';
                entities['162'] = '&cent;';
                entities['163'] = '&pound;';
                entities['164'] = '&curren;';
                entities['165'] = '&yen;';
                entities['166'] = '&brvbar;';
                entities['167'] = '&sect;';
                entities['168'] = '&uml;';
                entities['169'] = '&copy;';
                entities['170'] = '&ordf;';
                entities['171'] = '&laquo;';
                entities['172'] = '&not;';
                entities['173'] = '&shy;';
                entities['174'] = '&reg;';
                entities['175'] = '&macr;';
                entities['176'] = '&deg;';
                entities['177'] = '&plusmn;';
                entities['178'] = '&sup2;';
                entities['179'] = '&sup3;';
                entities['180'] = '&acute;';
                entities['181'] = '&micro;';
                entities['182'] = '&para;';
                entities['183'] = '&middot;';
                entities['184'] = '&cedil;';
                entities['185'] = '&sup1;';
                entities['186'] = '&ordm;';
                entities['187'] = '&raquo;';
                entities['188'] = '&frac14;';
                entities['189'] = '&frac12;';
                entities['190'] = '&frac34;';
                entities['191'] = '&iquest;';
                entities['192'] = '&Agrave;';
                entities['193'] = '&Aacute;';
                entities['194'] = '&Acirc;';
                entities['195'] = '&Atilde;';
                entities['196'] = '&Auml;';
                entities['197'] = '&Aring;';
                entities['198'] = '&AElig;';
                entities['199'] = '&Ccedil;';
                entities['200'] = '&Egrave;';
                entities['201'] = '&Eacute;';
                entities['202'] = '&Ecirc;';
                entities['203'] = '&Euml;';
                entities['204'] = '&Igrave;';
                entities['205'] = '&Iacute;';
                entities['206'] = '&Icirc;';
                entities['207'] = '&Iuml;';
                entities['208'] = '&ETH;';
                entities['209'] = '&Ntilde;';
                entities['210'] = '&Ograve;';
                entities['211'] = '&Oacute;';
                entities['212'] = '&Ocirc;';
                entities['213'] = '&Otilde;';
                entities['214'] = '&Ouml;';
                entities['215'] = '&times;';
                entities['216'] = '&Oslash;';
                entities['217'] = '&Ugrave;';
                entities['218'] = '&Uacute;';
                entities['219'] = '&Ucirc;';
                entities['220'] = '&Uuml;';
                entities['221'] = '&Yacute;';
                entities['222'] = '&THORN;';
                entities['223'] = '&szlig;';
                entities['224'] = '&agrave;';
                entities['225'] = '&aacute;';
                entities['226'] = '&acirc;';
                entities['227'] = '&atilde;';
                entities['228'] = '&auml;';
                entities['229'] = '&aring;';
                entities['230'] = '&aelig;';
                entities['231'] = '&ccedil;';
                entities['232'] = '&egrave;';
                entities['233'] = '&eacute;';
                entities['234'] = '&ecirc;';
                entities['235'] = '&euml;';
                entities['236'] = '&igrave;';
                entities['237'] = '&iacute;';
                entities['238'] = '&icirc;';
                entities['239'] = '&iuml;';
                entities['240'] = '&eth;';
                entities['241'] = '&ntilde;';
                entities['242'] = '&ograve;';
                entities['243'] = '&oacute;';
                entities['244'] = '&ocirc;';
                entities['245'] = '&otilde;';
                entities['246'] = '&ouml;';
                entities['247'] = '&divide;';
                entities['248'] = '&oslash;';
                entities['249'] = '&ugrave;';
                entities['250'] = '&uacute;';
                entities['251'] = '&ucirc;';
                entities['252'] = '&uuml;';
                entities['253'] = '&yacute;';
                entities['254'] = '&thorn;';
                entities['255'] = '&yuml;';
            }

            if (useQuoteStyle !== 'ENT_NOQUOTES') {
                entities['34'] = '&quot;';
            }
            if (useQuoteStyle === 'ENT_QUOTES') {
                entities['39'] = '&#39;';
            }
            entities['60'] = '&lt;';
            entities['62'] = '&gt;';

            // ascii decimals to real symbols
            for (decimal in entities) {
                if (entities.hasOwnProperty(decimal)) {
                    hash_map[String.fromCharCode(decimal)] = entities[decimal];
                }
            }

            return hash_map;
        },
        replaceQuote: function (str){
            if (str == undefined || str === ''){
                return '';
            }
            var single_quote_replace = '____---____';
            var double_quote_replace = '----___----';
            str = str.replace(/'/g,single_quote_replace);
            str = str.replace(/"/g,double_quote_replace);
            return str;
        },
        addQuote: function (str){
            if (str == undefined || str === ''){
                return '';
            }
            str = str.replace(/____---____/g,"'");
            str = str.replace(/----___----/g,'"');
            return str;
        },
        IsEmail: function (email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        },
        disabledAllFields: function (objectID){
            $("#"+objectID).find("input, textarea").attr('readonly','readonly');
            $("#"+objectID).find("select, input[type=checkbox], input[type=radio]").attr('disabled', true);
            $('.modal-footer').hide();
        },
        enableAllFields: function (objectID){
            $("#"+objectID).find("input, select, textarea, input[type=checkbox], input[type=radio]").removeAttr('readonly');
            $("#"+objectID).find("input, select, textarea, input[type=checkbox], input[type=radio]").attr('disabled', false);
            $('.modal-footer').show();
        },
        showGeneralPopUp: function (title, text, success){
            var icon_image = success ? 'icon_success.png' : 'icon_error.png';
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: title,
                // (string | mandatory) the text inside the notification
                text: text,
                // (string | optional) the image to display on the left
                image: '<?php echo base_url()?>application/views/images/'+icon_image,
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: false,
                // (int | optional) the time you want it to be alive for before fading out
                time: '5000',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
            });
        },
        sortFunction: function (arr,item,type) {
            arr.sort(function (a,b) {
                if (typeof a == "object" && typeof b == "object" ) {
                    //            console.log(a[item].toUpperCase());
                    if (type == 'ASC') {
                        if ( a[item].toUpperCase() < b[item].toUpperCase() )
                            return -1;
                        if ( a[item].toUpperCase() > b[item].toUpperCase() )
                            return 1;
                        return 0;
                    } else {
                        if ( a[item].toUpperCase() > b[item].toUpperCase() )
                            return -1;
                        if ( a[item].toUpperCase() < b[item].toUpperCase() )
                            return 1;
                        return 0;
                    }
                }
            });
            return arr;
        },
        disableOtherMethods: function (callFrom){
            if (cuadroGlobals.showCallingMethod) {
                console.log(callFrom);
            }

//            $('p').off('click');
//            $('div').off('click');
//            $('a').off('click');

            cuadroGlobals.methodCanRun = false;
        },
        enableOtherMethods: function (callFrom){
            if (cuadroGlobals.showCallingMethod) {
                console.log(callFrom);
            }

//            $('p').on('click');
//            $('div').on('click');
//            $('a').on('click');

            cuadroGlobals.methodCanRun = true;
        },

        showModalView: function (modalID){
            $('#' + modalID).modal({
                keyboard: false,
                backdrop: 'static',
                show: true
            });
        },

        checkForSession: function () {
//        console.log("footer");
            var str="chksession=true";
            jQuery.ajax({
                type: "POST",
                url: "<?php echo site_url('User/checkSession');?>",
                cache: false,
                success: function(res){
                    if(res == "1") {
                        <?php echo 'top.location=\''.site_url('User/logout').'\';';?>
                    }
                }
            });
        },
        resetModal: function (formID){
            $('#'+formID)
//                .not(.PromptType).val('');
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();

            $('#'+formID).bootstrapValidator({
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                }
            });

            $('button[type="submit"]').removeAttr('disabled');
        }
    }

    var cuadroServerAPI = {
        showErrorPopup: true,
        showLoaderPopup: true,
        getServerData: function (actionType, serverURL, dataType, methodName, callback) {
            console.log(serverURL);
            if (this.showLoaderPopup) {
                console.log('show loader model');
                $('#loaderModal').modal({
                    keyboard: false,
                    backdrop: 'static',
                    show: true
                });
//                cuadroCommonMethods.showModalView('loaderModal');
            }
            var returnValue = false;
            $.ajax({
                type: actionType,
                url: serverURL,
                dataType: dataType === '' ? 'text' : dataType,
                success: function(data, textStatus, jqXHR) {
                    returnValue = data;
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $("#loaderModal").modal('hide');
                    $(".modal-backdrop").remove();
                    if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    cuadroCommonMethods.enableOtherMethods(methodName);
                },
                statusCode: {
                    404: function() {
                        $("#loaderModal").modal('hide');
                        $(".modal-backdrop").remove();
                        cuadroCommonMethods.enableOtherMethods(methodName);
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                },
                timeout: 300000
            }).done(function(){
                    cuadroCommonMethods.enableOtherMethods(methodName);
                    if (returnValue == 0 && !(returnValue instanceof Array)) {
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                    console.log('hide loader model');
                    $('#loaderModal').modal('hide');
                    $(".modal-backdrop").remove();
                    this.showErrorPopup = true;
                    this.showLoaderPopup = true;
                    callback(returnValue);
                }
            );
        },
        postDataToServer: function (serverURL, postData, dataType, methodName, callback){
            var returnValue = false;
            if (this.showLoaderPopup) {
                console.log('show loader model');
                $('#loaderModal').modal({
                    keyboard: false,
                    backdrop: 'static',
                    show: true
                });
//                cuadroCommonMethods.showModalView('loaderModal');
            }
            $.ajax({
                type: 'POST',
                url: serverURL,
                data : postData,
                dataType: dataType === '' ? 'text' : dataType,
                success: function(data, textStatus, jqXHR) {
                    returnValue = data;
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('#loaderModal').modal('hide');
                    $(".modal-backdrop").remove();
                    if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    cuadroCommonMethods.enableOtherMethods(methodName);
                },
                statusCode: {
                    404: function() {
                        $('#loaderModal').modal('hide');
                        $(".modal-backdrop").remove();
                        cuadroCommonMethods.enableOtherMethods(methodName);
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                },
                timeout: 300000
            }).done(function(){
                    $('#loaderModal').modal('hide');
                    $(".modal-backdrop").remove();
                    cuadroCommonMethods.enableOtherMethods(methodName);
                    if (returnValue == 0 && !(returnValue instanceof Array)) {
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                    this.showErrorPopup = true;
                    callback(returnValue);
                });
        },
        getServerReportData: function (actionType, serverURL, dataType, methodName, callback) {
            var returnValue = false;
            if (this.showLoaderPopup) {
                console.log('show loader model');
                $('#loaderModal').modal({
                    keyboard: false,
                    backdrop: 'static',
                    show: true
                });
//                cuadroCommonMethods.showModalView('loaderModal');
            }
            $.ajax({
                type: actionType,
                url: serverURL,
                dataType: dataType === '' ? 'text' : dataType,
                success: function(data, textStatus, jqXHR) {
                    returnValue = data;
                },
                error: function(jqXHR, textStatus, errorThrown){
                    $('#loaderModal').modal('hide');
                    $(".modal-backdrop").remove();
                    if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    cuadroCommonMethods.enableOtherMethods(methodName);
                },
                statusCode: {
                    404: function() {
                        $('#loaderModal').modal('hide');
                        $(".modal-backdrop").remove();
                        cuadroCommonMethods.enableOtherMethods(methodName);
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                },
                timeout: 3000000
            }).done(function(){
                    $("#loaderModal").modal('hide');
                    $(".modal-backdrop").remove();
                    cuadroCommonMethods.enableOtherMethods(methodName);
//                console.log(returnValue);
                    if (returnValue == 0 && !(returnValue instanceof Array)) {
                        if (this.showErrorPopup) cuadroCommonMethods.showGeneralPopUp('Error!!!','<?php echo config_item('general_error_msg');?>', false);
                    }
                    this.showErrorPopup = true;
                    callback(returnValue);
                }
            );
        }
    }

    /*==Nice Scroll ==*/
    if ($.fn.niceScroll) {
        $(".leftside-navigation").niceScroll({
            cursorcolor: "#1FB5AD",
            cursorborder: "0px solid #fff",
            cursorborderradius: "0px",
            cursorwidth: "3px"
        });

        $(".leftside-navigation").getNiceScroll().resize();
        if ($('#sidebar').hasClass('hide-left-bar')) {
            $(".leftside-navigation").getNiceScroll().hide();
        }
        $(".leftside-navigation").getNiceScroll().show();

        $(".right-stat-bar").niceScroll({
            cursorcolor: "#1FB5AD",
            cursorborder: "0px solid #fff",
            cursorborderradius: "0px",
            cursorwidth: "3px"
        });
    }

    /*==Sidebar Toggle==*/

    $(".leftside-navigation .sub-menu > a").click(function () {
        var o = ($(this).offset());
        var diff = 80 - o.top;
        if (diff > 0)
            $(".leftside-navigation").scrollTo("-=" + Math.abs(diff), 500);
        else
            $(".leftside-navigation").scrollTo("+=" + Math.abs(diff), 500);
    });



    $('.sidebar-toggle-box .fa-bars').click(function (e) {

        $(".leftside-navigation").niceScroll({
            cursorcolor: "#1FB5AD",
            cursorborder: "0px solid #fff",
            cursorborderradius: "0px",
            cursorwidth: "3px"
        });

        $('#sidebar').toggleClass('hide-left-bar');
        if ($('#sidebar').hasClass('hide-left-bar')) {
            $(".leftside-navigation").getNiceScroll().hide();
        }
        $(".leftside-navigation").getNiceScroll().show();
        $('#main-content').toggleClass('merge-left');
        e.stopPropagation();
        if ($('#container').hasClass('open-right-panel')) {
            $('#container').removeClass('open-right-panel')
        }
        if ($('.right-sidebar').hasClass('open-right-bar')) {
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if ($('.header').hasClass('merge-header')) {
            $('.header').removeClass('merge-header')
        }


    });
    $('.toggle-right-box .fa-bars').click(function (e) {
        $('#container').toggleClass('open-right-panel');
        $('.right-sidebar').toggleClass('open-right-bar');
        $('.header').toggleClass('merge-header');

        e.stopPropagation();
    });

    $('.header,#main-content,#sidebar').click(function () {
        if ($('#container').hasClass('open-right-panel')) {
            $('#container').removeClass('open-right-panel')
        }
        if ($('.right-sidebar').hasClass('open-right-bar')) {
            $('.right-sidebar').removeClass('open-right-bar')
        }

        if ($('.header').hasClass('merge-header')) {
            $('.header').removeClass('merge-header')
        }


    });


    $('.panel .tools .fa').click(function () {
        var el = $(this).parents(".panel").children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200); }
    });



    $('.panel .tools .fa-times').click(function () {
        $(this).parents(".panel").parent().remove();
    });

    setInterval(cuadroCommonMethods.checkForSession, <?php echo config_item('check_session_expiry')?>);

    $(".upgradeSubscription").click(function(e){
        window.location.replace('<?php echo site_url("Subscription/updateSubscription")?>');
    });
</script>