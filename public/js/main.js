$(function () {
    const loader = $('#loader');
    const placeholder = $('#placeholder');
    const analysis = $('#analysis');

    $('#document-review').submit(function (e) {
        e.preventDefault();
        loader.show();

        const form = $(this);
        const file = form.find("[name='pdf']")[0].files[0];

        // Prefer files.
        if (file) {
            processPDF(
                form,
                ({data}) => {
                    loader.hide();
                    displayResult(data);
                },
                error => {
                    finishLoading();
                }
            );

            return;
        }

        // Fallback on text.
        processText(
            form,
            ({data}) => {
                loader.hide();
                displayResult(data);
            },
            error => {
                finishLoading();
            }
        );

        // setTimeout(function () {
        //     analysis.show();
        //     placeholder.removeClass('d-flex')
        //         .addClass('d-none');
        //     loader.hide();
        // }, 1000)
    });

    /**
     * Send text to the API.
     *
     * @param form
     * @param callback
     * @param error
     */
    function processText(form, callback, error) {
        const data = new FormData;

        data.append('text', form.find("[name='text']"))
        data.append('label', form.find("[name='label']").val())

        analyze(data, response => {
            callback(response);
        }, error => {
            console.error(error);
        }, baseUrl + '/process/file');
    }

    /**
     * Send PDF to the API.
     *
     * @param form
     * @param callback
     * @param error
     */
    function processPDF(form, callback, error) {
        const data = new FormData;
        const file = form.find("[name='pdf']")[0].files[0];

        data.append('pdf', file);
        data.append('label', form.find("[name='label']").val())

        analyze(data, response => {
            callback(response);
        }, error => {
            console.error(error);
        }, baseUrl + '/process/pdf');
    }

    /**
     * Send data to the API.
     *
     * @param {FormData} data
     * @param callback
     * @param errorCallback
     * @param {string} url
     */
    function analyze(data, callback, errorCallback, url) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: response => {
                console.log(response);
                callback(response);
            },
            error: error => {
                errorCallback(error);
            }
        });
    }

    /**
     * Mark page as done loading.
     */
    function finishLoading() {
        loader.hide();
    }

    /**
     * Display the data extracted from analysis.
     *
     * @param {Array} data
     */
    function displayResult(data) {
        const resultSet = $('#result-set');

        resultSet.empty();

        // Format results using template.
        for (let datum in data) {
            let template = $('#list-template').clone();
            let content = '';

            template.removeClass('d-none').addClass('d-flex').removeAttr('id');

            // todo: format template and append to result-set.
            template.find('.title').html('');
            template.find('.year').html('');
            // resultSet.append(content);
        }

        // Show what needs to be shown.
        placeholder.removeClass('d-flex').addClass('d-none');
        analysis.hide();
    }
})