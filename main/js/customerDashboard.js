$(function () {

    var scripts = document.getElementsByTagName('script');
    var lastScript = scripts[scripts.length-3];
    var scriptName = lastScript;

    var amntToPay = scriptName.getAttribute('amntToPay');
    var paidAmount = scriptName.getAttribute('paidAmount');

var data = {
    labels: ['Amount to be paid', 'Paid Amount'],
    series: [parseInt(amntToPay), parseInt(paidAmount)]
};

var options = {
    labelInterpolationFnc: function(value) {
        return value[0]
    }
};

var responsiveOptions = [
    ['screen and (min-width: 640px)', {
        chartPadding: 30,
        labelOffset: 100,
        labelDirection: 'explode',
        labelInterpolationFnc: function(value) {
            return value;
        }
    }],
    ['screen and (min-width: 1024px)', {
        labelOffset: 80,
        chartPadding: 20
    }]
];

new Chartist.Pie('.ct-chart', data, options, responsiveOptions);
});