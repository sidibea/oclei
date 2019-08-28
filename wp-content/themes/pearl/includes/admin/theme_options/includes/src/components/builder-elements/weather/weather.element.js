export class WeatherElementController {
    constructor($http,$mdDialog) {
        this.$http = $http;
        this.appId = '726d77feab5c453c37f3f57a7ef10177';
        this.apiUrl = 'http://api.openweathermap.org/data/2.5/weather?q=';
        this.units = [
            {
                name: 'imperial',
                symbol: '°F'
            },
            {
                name: 'metric',
                symbol: '°C'
            },
        ];
        this.unit = 'metric';
        this.weather = 'N/A';
        this.$mdDialog = $mdDialog;
        console.log(this.element);
        if (typeof this.element.value === 'undefined') {
            this.element.value = {
                city: 'New York',
                units: 'metric'
            }
        }
    }


    getWeather() {
        let city = encodeURI(this.element.value.city);
        let req = `${this.apiUrl}${city}&APPID=${this.appId}&units=${this.unit}`;
        this.$http({
            method: 'get',
            url: req
        }).then((res) => {
            console.log(res);
            if (res.status === 200) {
                this.weather = '°' + res.data.main.temp;
            }
        }, (error) => {
            this.weather = 'Error';
        })
    }

    saveElement(element) {
        this.$mdDialog.hide(element);
    }

    cancel() {
        this.$mdDialog.cancel();
    }
}