/**
* AJAX module
*/
var ajax = (function () {

    /**
    * @usage codex.ajax.call();
    */
    var call = function (data) {

        if (!data || !data.url) return;

        var XMLHTTP          = window.XMLHttpRequest ? new window.XMLHttpRequest() : new window.ActiveXObject('Microsoft.XMLHTTP'),
            successFunction  = function () {};

        data.async           = true;
        data.type            = data.type || 'GET';
        data.data            = data.data || '';
        data['content-type'] = data['content-type'] || 'application/json; charset=utf-8';
        successFunction      = data.success || successFunction;

        if (data.type == 'GET' && data.data) {

            data.url = /\?/.test(data.url) ? data.url + '&' + data.data : data.url + '?' + data.data;

        }

        if (data.withCredentials) {

            XMLHTTP.withCredentials = true;

        }

        if (data.beforeSend && typeof data.beforeSend == 'function') {

            data.beforeSend.call();

        }

        XMLHTTP.open(data.type, data.url, data.async);

        /**
        * If we send FormData, we need no content-type header
        */
        if (!isFormData(data.data)) {

            XMLHTTP.setRequestHeader('Content-type', data['content-type']);

        }

        XMLHTTP.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        XMLHTTP.onreadystatechange = function () {

            if (XMLHTTP.readyState == 4 && XMLHTTP.status == 200) {

                successFunction(XMLHTTP.responseText);

            }

        };

        XMLHTTP.send(data.data);

    };

    /**
     * Function for checking is it FormData object to send.
     * @param {Object} object to check
     * @return boolean
     */
    function isFormData(object) {

        return typeof object.append === 'function';

    };

    return {

        call : call

    };

}());

module.exports = ajax;
