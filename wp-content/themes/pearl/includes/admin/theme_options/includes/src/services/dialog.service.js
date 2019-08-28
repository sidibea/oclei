export class DialogService {
    constructor($uibModal, $q) {
        'ngInject';

        this.$modal = $uibModal;
        this.$q = $q;
    }



    fromTemplate(templateName, options = {}) {

        options.templateUrl = `${ngAppPath}modals/${templateName}/${templateName}.modal.html`;

         let modal = this.$modal.open(options);

        return modal;
    }

    close (modal) {
        return modal.dismiss('cancel');
    }

    confirm (modal, data) {
        return modal.close(data)
    }

    getResult (modal) {

        let deferred = this.$q.defer();

        modal.result.then(
            (data) => {
                deferred.resolve(data);
            },
            (dismiss) => {
                deferred.reject(dismiss);
            }
        )

        return deferred.promise;
    }





}