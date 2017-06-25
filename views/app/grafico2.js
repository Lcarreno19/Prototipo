var chart = AmCharts.makeChart("chartdiv2", {
    "type": "pie",
    "theme": "light",
    "innerRadius": "40%",
    "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
    "dataProvider": [{
        "mes": "consultor1",
        "total": 501.9
    }, {
        "mes": "consultor2",
        "total": 301.9
    }, {
        "mes": "consultor3",
        "total": 201.1
    }, {
        "mes": "consultor4",
        "total": 165.8
    }, {
        "mes": "consultor5",
        "total": 139.9
    }, {
        "mes": "consultor6",
        "total": 128.3
    }],
    "balloonText": "[[value]]",
    "valueField": "total",
    "titleField": "mes",
    "balloon": {
        "drop": true,
        "adjustBorderColor": false,
        "color": "#FFFFFF",
        "fontSize": 16
    },
    "export": {
        "enabled": true
    }
});
