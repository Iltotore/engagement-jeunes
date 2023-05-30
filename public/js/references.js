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


function toggleConsultMenu() {
    const consultMenu = document.getElementById("consult_menu")
    consultMenu.hidden = !consultMenu.hidden
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
