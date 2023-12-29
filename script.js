$(document).ready(function () {
    var totalSteps = 3; // Set the total number of steps
    var currentStep = 1;

    showStep(currentStep);

    $('.btn-next').click(function () {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
            updateProgressBar(currentStep);
        }
    });

    $('.btn-prev').click(function () {
        currentStep--;
        showStep(currentStep);
        updateProgressBar(currentStep);
    });

    function showStep(step) {
        $('.step').hide();
        $('.step:nth-child(' + step + ')').show();

        // Show/hide buttons based on the current step
        if (step === 1) {
            $('.btn-prev').hide();
        } else {
            $('.btn-prev').show();
        }

        if (step === totalSteps) {
            $('.btn-next').hide();
            $('.btn-submit').show();
        } else {
            $('.btn-next').show();
            $('.btn-submit').hide();
        }
    }

    function validateStep(step) {
        // Add your validation logic here
        return true;
    }

    function updateProgressBar(step) {
        var progress = ((step - 1) / totalSteps) * 100;
        $('#progress').css('width', progress + '%');
    }
});