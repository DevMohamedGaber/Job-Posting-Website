const mainEl = document.getElementById("MainBody")
const ErrBox = document.getElementById("ErrorBox")

// calls
async function OnLogin(e) {
    e.preventDefault()

    let formData = new FormData(e.target);
    
    const response = await fetch('/handlers/login.php', {
        method: "POST",
        body: formData
    })

    res = await response.text()

    if(res != "Done") {
        HandleErrors(res)
        return
    }
    window.location.href = '/index.php'
}

async function OnRegister(e) {
    e.preventDefault()

    let formData = new FormData(e.target);

    if(!formData.has("is_recruiter")) {
        formData.append("is_recruiter", 0)
    } else {
        formData.set("is_recruiter", 1)
    }

    const response = await fetch('/handlers/register.php', {
        method: "POST",
        body: formData,
    })
    res = await response.text()

    if(res != "Done") {
        HandleErrors(res)
        return
    }

    SwitchForms()
}

// helpers
function SwitchForms() {
    ErrBox.innerHTML = ''
    mainEl.classList.toggle('registering')
    return false
}

function HandleErrors(errs) {
    ErrBox.innerHTML = ''
    if(Array.isArray(errs)) {
        for(err of errs) {
            ErrBox.innerHTML += '<p>' + err + '<?p>'
        }
        return
    }
    ErrBox.innerHTML+= '<p>' + errs + '<?p>'
}