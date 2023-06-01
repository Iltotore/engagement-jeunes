function getSelectedReferences() {
    return [...document.getElementsByClassName("select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

function removeSelectedReferences() {
    const form = document.getElementById("remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedReferences().join(",")

    form.submit()
}

function toggleConsultMenu() {
    const consultMenu = document.getElementById("consult_menu")
    consultMenu.hidden = !consultMenu.hidden
}

function sendReferences() {
    const emailInput = document.querySelector("div#consult_menu > input[name='email']")
    const durationInput = document.querySelector("div#consult_menu > select[name='duration']")

    const form = document.getElementById("send_form")
    const selected = form.querySelector('input[name="selected"]')
    const email = form.querySelector('input[name="email"]')
    const duration = form.querySelector('input[name="duration"]')

    selected.value = getSelectedReferences().join(",")
    email.value = emailInput.value
    duration.value = durationInput.value

    form.submit()
}
