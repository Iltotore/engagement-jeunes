function getSelectedReferences() {
    return [...document.querySelectorAll(".reference > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

function getSelectedConsults() {
    return [...document.querySelectorAll(".consult > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

function removeSelectedReferences() {
    const form = document.getElementById("ref_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedReferences().join(",")

    form.submit()
}

function removeSelectedConsults() {
    const form = document.getElementById("consult_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedConsults().join(",")

    form.submit()
}

function toggleMenu(widget) {
    widget.hidden = !widget.hidden
}

function toggleConsultMenu() {
    toggleMenu(document.getElementById("consult_menu"))
}

function toggleReferences(button) {
    const consult = button.parentNode
    const container = consult.querySelector(".reference_container")

    //TODO Button icon open/close animation

    toggleMenu(container);
}

function sendReferences() {
    const emailInput = document.querySelector("div#consult_menu > input[name='email']")
    const durationInput = document.querySelector("div#consult_menu > select[name='duration']")

    const form = document.getElementById("ref_send_form")
    const selected = form.querySelector('input[name="selected"]')
    const email = form.querySelector('input[name="email"]')
    const duration = form.querySelector('input[name="duration"]')

    selected.value = getSelectedReferences().join(",")
    email.value = emailInput.value
    duration.value = durationInput.value

    form.submit()
}