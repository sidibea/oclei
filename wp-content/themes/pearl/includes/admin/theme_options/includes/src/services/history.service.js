export class HistoryService {
    constructor ($rootScope) {
        this.$root = $rootScope;
        this.object = {};
        this.steps = 50;
        this.backups = [];
        this.variable = '';
        this.history = '';
        this.undoTrigerred = false;
    }

    watch(variable) {
        this.variable = variable;

        this.$root.$watch(this.variable, (newValue, oldValue) => {


            let equals = angular.equals(newValue, oldValue);


            if (!equals && !this.undoTrigerred) {
                let backup = angular.copy(oldValue);

                if (this.backups.length > 70) {
                    this.backups.shift();
                }

                this.backups.push(backup);
            }


        }, true)
    }

    undo() {
        if (this.backups.length) {
            let last_backup = this.backups.pop();
            this.$root[this.variable] = Object.assign({}, this.$root[this.variable], last_backup);
        }
        this.undoTrigerred = true;
    }




}