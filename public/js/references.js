/**
 * Get added skills of a given type.
 *
 * @param type the type of skills to get
 * @returns {string[]} the list of skill names
 */
function getSkills(type) {
    const skillList = document.getElementById(`${type}_skills`)

    return [...skillList.getElementsByTagName("li")]
        .map(li => li.id.substring(4))
}

/**
 * Add a new skill.
 *
 * @param type the type of the new skill
 */
function addSkill(type) {
    const newSkill = document.querySelector(`div > input[name='${type}_skill']`)
    const skillList = document.getElementById(`${type}_skills`)

    const skillName = newSkill.value.trim()

    const newEntry = document.createElement("li")
    newEntry.id=`ref_${skillName}`
    newEntry.innerHTML = `${skillName}<button onclick="this.parentNode.remove()">-</button>`

    if(skillName.length !== 0 && !getSkills(type).includes(skillName)) skillList.appendChild(newEntry)
}

/**
 * Get selected references.
 *
 * @returns {string[]} the reference ids
 */
function getSelectedReferences() {
    return [...document.querySelectorAll(".reference > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

/**
 * Get selected consults.
 *
 * @returns {string[]} the consult ids
 */
function getSelectedConsults() {
    return [...document.querySelectorAll(".consult > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

/**
 * Add a new reference.
 */
function addReference() {
    const description = document.querySelector("#add_menu > label > textarea[name='description']").value
    const area = document.querySelector("#add_menu > label > input[name='area']").value
    const beginDate = document.querySelector("#add_menu > label > input[name='begin_date']").value
    const endDate = document.querySelector("#add_menu > label > input[name='end_date']").value
    const email = document.querySelector("#add_menu > label > input[name='email']").value
    const firstName = document.querySelector("#add_menu > label > input[name='first_name']").value
    const lastName = document.querySelector("#add_menu > label > input[name='last_name']").value
    const birthDate = document.querySelector("#add_menu > label > input[name='birth_date']").value

    const form = document.getElementById("add_form")
    form.querySelector("textarea[name='description']").value = description
    form.querySelector("input[name='area']").value = area
    form.querySelector("input[name='begin_date']").value = beginDate
    form.querySelector("input[name='end_date']").value = endDate
    form.querySelector("input[name='email']").value = email
    form.querySelector("input[name='first_name']").value = firstName
    form.querySelector("input[name='last_name']").value = lastName
    form.querySelector("input[name='birth_date']").value = birthDate
    form.querySelector("input[name='hard_skills']").value = getSkills("hard").join(",")
    form.querySelector("input[name='soft_skills']").value = getSkills("soft").join(",")

    form.submit()
}

/**
 * Remove selected references.
 */
function removeSelectedReferences() {
    const form = document.getElementById("ref_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedReferences().join(",")

    form.submit()
}

/**
 * Remove selected consults.
 */
function removeSelectedConsults() {
    const form = document.getElementById("consult_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedConsults().join(",")

    form.submit()
}

/**
 * Open/Close the given menu and closes others.
 * @param widget
 */
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

    toggleMenu(container);
}

/**
 * Send references to a consultant
 */
function sendReferences() {
    const emailInput = document.querySelector("#consult_menu > label > input[name='email']")
    const durationInput = document.querySelector("#consult_menu > label > select[name='duration']")

    const form = document.getElementById("ref_send_form")
    const selected = form.querySelector('input[name="selected"]')
    const email = form.querySelector('input[name="email"]')
    const duration = form.querySelector('input[name="duration"]')

    selected.value = getSelectedReferences().join(",")
    email.value = emailInput.value
    duration.value = durationInput.value

    form.submit()
}

/**
 * Summarize the selected references.
 */
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
