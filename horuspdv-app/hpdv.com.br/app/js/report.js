const formReportClient = document.querySelector('#formReportClient');
formReportClient.addEventListener('submit', function (e) {
    e.preventDefault();

    let reportType = document.querySelector('#report_type_client');
    let reportingPeriod = document.querySelector('#reporting_period');

    if (reportType.selectedIndex != 0 && reportingPeriod.selectedIndex != 0) {
        let action = document.querySelector('input[name="action"]').value;
        let csrfToken = document.querySelector('input[name="csrf_token"]').value;
        window.open('../report/reports.php?action=' + action + '&report_type=' + reportType.value + '&reporting_period=' + reportingPeriod.value + '&csrf_token=' + csrfToken, '_blank');
    }
})

const formReportProduct = document.querySelector('#formReportProduct');
formReportProduct.addEventListener('submit', function (e) {
    e.preventDefault();

    let reportType = document.querySelector('#report_type_product');
    let reportingPeriod = document.querySelector('#reporting_period_product');

    if (reportType.selectedIndex != 0 && reportingPeriod.selectedIndex != 0) {

        let action = document.querySelector('input[name="action_product"]').value;
        let csrfToken = document.querySelector('input[name="csrf_token"]').value;
        window.open('../report/reports.php?action=' + action + '&report_type=' + reportType.value + '&reporting_period=' + reportingPeriod.value + '&csrf_token=' + csrfToken, '_blank');
    }
})

const formReportProvider = document.querySelector('#formReportProvider');
formReportProvider.addEventListener('submit', function (e) {
    e.preventDefault();

    let reportType = document.querySelector('#report_type_provider');
    let reportingPeriod = document.querySelector('#reporting_period_provider');

    if (reportType.selectedIndex != 0 && reportingPeriod.selectedIndex != 0) {

        let action = document.querySelector('input[name="action_provider"]').value;
        let csrfToken = document.querySelector('input[name="csrf_token"]').value;
        window.open('../report/reports.php?action=' + action + '&report_type=' + reportType.value + '&reporting_period=' + reportingPeriod.value + '&csrf_token=' + csrfToken, '_blank');
    }
})

const formReportSales = document.querySelector('#formReportSales');
formReportSales.addEventListener('submit', function (e) {
    e.preventDefault();

    let reportType = document.querySelector('#report_type_sales');
    let reportingPeriod = document.querySelector('#reporting_period_sales');
    let paymentOption = document.querySelector('#payment_option');

    if (reportType.selectedIndex != 0 && reportingPeriod.selectedIndex != 0 && paymentOption.selectedIndex != 0) {

        let action = document.querySelector('input[name="action_sales"]').value;
        let csrfToken = document.querySelector('input[name="csrf_token"]').value;
        window.open('../report/reports.php?action=' + action + '&report_type=' + reportType.value + '&reporting_period=' + reportingPeriod.value + '&payment_option=' + paymentOption.value + '&csrf_token=' + csrfToken, '_blank');
    }
})