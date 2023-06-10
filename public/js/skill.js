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
 * Edit the current reference.
 */
function sendEdit() {
    const form = document.getElementById("edit_form")
    const hardSkillsInput = form.querySelector("input[name='hard_skills']")
    const softSkillsInput = form.querySelector("input[name='soft_skills']")
    const firstNameInput = form.querySelector("input[name='ref_first_name']")
    const lastNameInput = form.querySelector("input[name='ref_last_name']")
    const birthDateInput = form.querySelector("input[name='ref_birth_date']")

    hardSkillsInput.value = getSkills("hard").join(",")
    softSkillsInput.value = getSkills("soft").join(",")

    firstNameInput.value = document.querySelector("label > input[name='ref_first_name']").value
    lastNameInput.value = document.querySelector("label > input[name='ref_last_name']").value
    birthDateInput.value = document.querySelector("label > input[name='ref_birth_date']").value

    form.submit()
}
