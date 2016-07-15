
$("document").ready(function() {

    var i = -1;
    var toastCount = 0;
    var $toastlast;

    var getMessage = function () {
        var msgs = ['Defalut Toast Executed'];
        i++;
        if (i === msgs.length) {
            i = 0;
        }

        return msgs[i];
    };

    var getMessageWithClearButton = function (msg) {
        msg = msg ? msg : 'Clear itself?';
        //msg += '<br /><br /><button type="button" class="btn clear">Yes</button>';
        return msg;
    };

    $.fn.showToast = function (msgx, titlex, toastType) {
        console.log("Toast initiated!");
        console.log("Message:"+msgx);
        console.log("Title:"+titlex);
        console.log("Type:"+toastType);
        var shortCutFunction = toastType;
        var msg = msgx;
        var title = titlex || '';
        var $showDuration = 300;
        var $hideDuration = 1000;
        var $timeOut = 5000;
        var $extendedTimeOut = 1000;
        var $showEasing = "swing";
        var $hideEasing = "linear";
        var $showMethod = "fadeIn";
        var $hideMethod = "fadeOut";
        var toastIndex = toastCount++;
        var addClear = false;

        toastr.options = {
            closeButton: true,
            debug: true,
            newestOnTop: true,
            progressBar: true,
            //positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
            //preventDuplicates: $('#preventDuplicates').prop('checked'),
            onclick: null
        };

        if ($showDuration) {
            toastr.options.showDuration = $showDuration;
        }

        if ($hideDuration) {
            toastr.options.hideDuration = $hideDuration;
        }

        if ($timeOut) {
            toastr.options.timeOut = addClear ? 0 : $timeOut;
        }

        if ($extendedTimeOut) {
            toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut;
        }

        if ($showEasing) {
            toastr.options.showEasing = $showEasing;
        }

        if ($hideEasing) {
            toastr.options.hideEasing = $hideEasing;
        }

        if ($showMethod) {
            toastr.options.showMethod = $showMethod;
        }

        if ($hideMethod) {
            toastr.options.hideMethod = $hideMethod;
        }

        if (addClear) {
            msg = getMessageWithClearButton(msg);
            toastr.options.tapToDismiss = false;
        }
        if (!msg) {
            msg = getMessage();
        }

        $('#toastrOptions').text('Command: toastr["'
            + shortCutFunction
            + '"]("'
            + msg
            + (title ? '", "' + title : '')
            + '")\n\ntoastr.options = '
            + JSON.stringify(toastr.options, null, 2)
        );

        var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;

        if(typeof $toast === 'undefined'){
            return;
        }

        return true;
    };

    function getLastToast(){
        return $toastlast;


    }

});
