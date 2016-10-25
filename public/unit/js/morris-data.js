$(function() {
    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2016-03',
            m1: 16,
            m2: 12,
            m3: 32,
            m4: 25,
            m5: 100,
            m6: 10,
            m7: 2,
            m8: 8,
            m9: 12,
            m10: 31,
            m11: 60,
            m12: 80
        }, {
            period: '2016-04',
            m1: 20,
            m2: 11,
            m3: 32,
            m4: 25,
            m5: 90,
            m6: 8,
            m7: 3,
            m8: 5,
            m9: 12.7,
            m10: 31.4,
            m11: 58,
            m12: 69
        }, {
            period: '2016-05',
            m1: 17,
            m2: 12,
            m3: 32,
            m4: 25,
            m5: 100,
            m6: 10,
            m7: 2,
            m8: 8.5,
            m9: 15,
            m10: 25,
            m11: 70,
            m12: 68
        }, {
            period: '2016-06',
            m1: 18,
            m2: 11,
            m3: 32,
            m4: 25,
            m5: 100,
            m6: 8,
            m7: 6,
            m8: 4,
            m9: 23,
            m10: 40,
            m11: 70,
            m12: 91
        }, {
            period: '2016-07',
            m1: 20,
            m2: 10,
            m3: 32,
            m4: 25,
            m5: 58,
            m6: 7,
            m7: 2,
            m8: 2,
            m9: 3,
            m10: 15,
            m11: 37,
            m12: 41
        }
        ],
        xkey: 'period',
        ykeys: ['m1', 'm2', 'm3', 'm4', 'm5', 'm6', 'm7', 'm8', 'm9', 'm10', 'm11', 'm12'],
        labels: ['Measure 1', 'Measure 2', 'Measure 3', 'Measure 4', 'Measure 5', 'Measure 6', 'Measure 7', 'Measure 8', 'Measure 9', 'Measure 10', 'Measure 11', 'Measure 12'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Q1 2016",
            value: 79.34
        }, {
            label: "Q2 2016",
            value: 64
        }, {
            label: "Q3 2016",
            value: 87
        }, {
            label: "Q4 2016",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2016-03',
            a: 100,
            b: 90
        }, {
            y: '2016-04',
            a: 75,
            b: 65
        }, {
            y: '2016-05',
            a: 50,
            b: 40
        }, {
            y: '2016-06',
            a: 75,
            b: 65
        }, {
            y: '2016-07',
            a: 50,
            b: 40
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Target', 'Accomplishment'],
        hideHover: 'auto',
        resize: true
    });

});
