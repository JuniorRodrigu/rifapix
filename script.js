const myInput = document.getElementById("my-input");

function stepper(btn) {
    let id, min, max, step, val, calcStep, newValue;

    if (btn) {
        id = btn.getAttribute("id");
    } else {
        id = "manual";
    }

    min = myInput.getAttribute("min");
    max = myInput.getAttribute("max");
    step = myInput.getAttribute("step");
    val = myInput.value;
    calcStep = (id == "increment") ? (step*1) : (step * -1);
    newValue = parseInt(val) + calcStep;

    if (newValue >= min && newValue <= max) {
        myInput.value = newValue;
    }
}
