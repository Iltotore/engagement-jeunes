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
