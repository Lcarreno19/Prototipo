  var chart = AmCharts.makeChart( "chartdiv", {
      "type": "serial",
      "theme": "light",
      "dataProvider": [ {
        "country": "Ene",
        "visits": 1234
      }, {
        "country": "Feb",
        "visits": 123
      }, {
        "country": "Mar",
        "visits": 2421
      }, {
        "country": "Abr",
        "visits": 213213
      }, {
        "country": "May",
        "visits": 312
      }, {
        "country": "Jun",
        "visits": 32131
      }, {
        "country": "Jul",
        "visits": 3213
      }, {
        "country": "Ago",
        "visits": 1213
      }, {
        "country": "Sep",
        "visits": 21321
      }, {
        "country": "Oct",
        "visits": 41512
      }, {
        "country": "Nov",
        "visits": 3213
      },{
        "country": "Dic",
        "visits": 233
      } ],
      "valueAxes": [ {
        "gridColor": "#FFFFFF",
        "gridAlpha": 0.2,
        "dashLength": 0
      } ],
      "gridAboveGraphs": true,
      "startDuration": 1,
      "graphs": [ {
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
      } ],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "country",
      "categoryAxis": {
        "gridPosition": "start",
        "gridAlpha": 0,
        "tickPosition": "start",
        "tickLength": 20
      },
      "export": {
        "enabled": true
      }

    } );