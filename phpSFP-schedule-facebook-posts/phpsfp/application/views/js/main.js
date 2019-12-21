$(document).ready(function(){

    /* Datepicker */
    $("#datepicker-1").datetimepicker({ dateFormat: 'mm/dd/yy', minDate: 0, currentText: LNG_DTP_currentText, closeText: LNG_DTP_closeText, timeOnlyTitle: LNG_DTP_timeOnlyTitle, timeText: LNG_DTP_timeText, hourText: LNG_DTP_hourText, minuteText: LNG_DTP_minuteText, secondText: LNG_DTP_secondText, millisecText: LNG_DTP_millisecText, microsecText: LNG_DTP_microsecText, timezoneText: LNG_DTP_timezoneText });
    $("#datepicker-repeat").datetimepicker({ dateFormat: 'mm/dd/yy', minDate: 0, currentText: LNG_DTP_currentText, closeText: LNG_DTP_closeText, timeOnlyTitle: LNG_DTP_timeOnlyTitle, timeText: LNG_DTP_timeText, hourText: LNG_DTP_hourText, minuteText: LNG_DTP_minuteText, secondText: LNG_DTP_secondText, millisecText: LNG_DTP_millisecText, microsecText: LNG_DTP_microsecText, timezoneText: LNG_DTP_timezoneText });
    $("#datepicker-2").datepicker({
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
        onClose: function( selectedDate )
        {
            $("#datepicker-3").datepicker( "option", "minDate", selectedDate );
        }
    });

    $("#datepicker-3").datepicker({
        defaultDate: "+1w",
        changeMonth: false,
        numberOfMonths: 1,
        dateFormat: 'mm/dd/yy',
        onClose: function( selectedDate )
        {
            $("#datepicker-2").datepicker( "option", "maxDate", selectedDate );
        }
    });

    /* Toggle */
    $('.toggle-wrap .toggle').click(function() {
        $(this).toggleClass('collapse');
        $(this).parents('.toggle-wrap').find('.content').slideToggle();
        return false;
    });

    // Modal
    var fadeSpd = 150;
    $('.modal').click(function () {
        var modalId = $(this).attr('href').replace('#','');
        $('#'+modalId).fadeIn(fadeSpd);
        $('#mask').fadeIn(fadeSpd);
        return false;
    });

    $('.btn-close, #mask').click(function () {
        $('.window').fadeOut(fadeSpd);
        $('#mask').fadeOut(fadeSpd);
    });
});