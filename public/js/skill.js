function getSkills(type) {
    const skillList = document.getElementById(`${type}_skills`)

    return [...skillList.getElementsByTagName("li")]
        .map(li => li.id.substring(4))
}

function addSkill(type) {
    const newSkill = document.querySelector(`div > input[name='${type}_skill']`)
    const skillList = document.getElementById(`${type}_skills`)

    const skillName = newSkill.value.trim()

    const newEntry = document.createElement("li")
    newEntry.id=`ref_${skillName}`
    newEntry.innerHTML = `${skillName}<button onclick="this.parentNode.remove()">-</button>`

    if(skillName.length !== 0 && !getSkills(type).includes(skillName)) skillList.appendChild(newEntry)
}

function sendEdit() {
    const form = document.getElementById("edit_form")
    const hardSkillsInput = form.querySelector("input[name='hard_skills']")
    const softSkillsInput = form.querySelector("input[name='soft_skills']")

    hardSkillsInput.value = getSkills("hard").join(",")
    softSkillsInput.value = getSkills("soft").join(",")

    form.submit()
}
