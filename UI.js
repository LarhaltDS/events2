//################ config fullcalendar ###############

var monthNames = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
var monthNamesShort = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
var dayNames = ['Domenica', 'LunedÃ¬', 'MartedÃ¬', 'MercoledÃ¬', 'GiovedÃ¬', 'VenerdÃ¬', 'Sabato'];
var dayNamesShort = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];


$fullCalendarOptions = {
    firstDay: 1,
    weekMode: 'variable',
    defaultView: 'month',
    editable: false,
    selectable: true,
    slotMinutes: 15,
    aspectRatio: 2,
    header: {
        left: 'month,agendaWeek,agendaDay',
        center: 'title',
        right: 'today prev,next'
    },
    buttonText: {
        prev: "<span class='fc-text-arrow'>&lsaquo;</span>",
        next: "<span class='fc-text-arrow'>&rsaquo;</span>",
        prevYear: "<span class='fc-text-arrow'>&laquo;</span>",
        nextYear: "<span class='fc-text-arrow'>&raquo;</span>",
        today: 'oggi',
        month: 'mese',
        week: 'settimana',
        day: 'giorno'
    },
    allDayText: '<small>tutto il giorno</small>',
    titleFormat: {
        month: 'MMMM yyyy',
        week: "d [ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}",
        day: 'd MMMM yyyy'
    },
    columnFormat: {
        month: 'ddd',
        week: 'ddd d/M',
        day: 'dddd d/M'
    },
    axisFormat: 'H:mm',
    timeFormat: {
        '': 'H:mm',
        agenda: 'H:mm{ - H:mm}'
    },
    monthNames: monthNames,
    monthNamesShort: monthNamesShort,
    dayNames: dayNames,
    dayNamesShort: dayNamesShort,
};

//Uso:
//$('[calendar selector]').fullCalendar($.extend({ [local options] }, $fullCalendarOptions));