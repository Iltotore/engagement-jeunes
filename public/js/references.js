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
    const old = widget.hidden
    for(let node of Array.from(document.getElementById("actions_menu").childNodes)) node.hidden = true
    widget.hidden = !old
}

function toggleConsultMenu() {
    toggleMenu(document.getElementById("consult_menu"))
}

function toggleAddMenu() {
    toggleMenu(document.getElementById("add_menu"))
}

function toggleReferences(button) {
    const consult = button.parentNode
    const container = consult.querySelector(".reference_container")

    //TODO Button icon open/close animation

    toggleMenu(container);
}

function sendReferences() {
    const emailInput = document.querySelector("#consult_menu > input[name='email']")
    const durationInput = document.querySelector("#consult_menu > select[name='duration']")

    const form = document.getElementById("ref_send_form")
    const selected = form.querySelector('input[name="selected"]')
    const email = form.querySelector('input[name="email"]')
    const duration = form.querySelector('input[name="duration"]')

    selected.value = getSelectedReferences().join(",")
    email.value = emailInput.value
    duration.value = durationInput.value

    form.submit()
}

function generateSummary() {
	const fakeForm = document.getElementById("generation_menu")
	const realForm = document.getElementById("generation_form")

	const selected = realForm.querySelector('input[name="selected"]')
	selected.value = getSelectedReferences().join(",")

	if(fakeForm.querySelector('input[value="PDF"]').checked) {
		realForm.querySelector('input[value="PDF"]').checked = true;
	} else if (fakeForm.querySelector('input[value="HTML"]').checked) {
		realForm.querySelector('input[value="HTML"]').checked = true;
	}

	realForm.submit()
}