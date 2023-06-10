function getSelectedUsers() {
    return [...document.querySelectorAll(".user > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

function removeSelectedUsers() {
    const form = document.getElementById("user_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedUsers().join(",")

    form.submit()
}

function getSelectedReferences() {
    return [...document.querySelectorAll(".reference > .select")]
        .filter(box => box.checked)
        .map(box => box.name)
}

function removeSelectedReferences() {
    const form = document.getElementById("ref_remove_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = getSelectedReferences().join(",")

    form.submit()
}

function displayUser(id) {
    const form = document.getElementById("user_select_form")
    const selected = form.querySelector('input[name="selected"]')
    selected.value = id

    form.submit()
}
