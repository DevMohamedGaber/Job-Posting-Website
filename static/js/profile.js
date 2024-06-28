// const API = 'http://localhost/'
// const expList = document.getElementById('exp-list')
// const skillsList = document.getElementById('skill-list')
// const expTemplate = expList.children[0]
// const skillTemplate = '<div class="skill"></div>'

// var userToken = window.localStorage.getItem("userToken")

// expList.innerHTML = ''

// window.onload = async () => {
//     const params = new URLSearchParams(window.location.search)
//     let id = null
//     if(userToken !== null && params.has('id')) {
//         id = params.get('id')
//     }
//     const req = await GetUser(id)

//     if(!req['status']) {
//         console.log(req['data']);
//         return
//     }

//     const user = req['data']['user']
//     document.getElementById("profile-name").innerHTML = `${user['Fame']} ${user['Lname']}`
//     document.getElementById("profile-title").innerHTML = user['title']
//     document.getElementById("industry").innerHTML = user['industry']
//     document.getElementById("email").innerHTML = user['email']
//     document.getElementById("phone").innerHTML = user['phone']
//     document.getElementById("address").innerHTML = user['address']
//     document.getElementById("about-data").innerHTML = user['about']

//     const exps = req['data']['experience']
//     if(exps != null && exps.length > 0) {
//         for (let i = 0; i < exps.length; i++) {
//             const exp = exps[i];
//             const el = expTemplate.cloneNode(true)
//             el.querySelector(".exp-title").innerHTML = exp['title']
//             el.querySelector(".company-period").innerHTML = `${exp['company_name']} | ${exp['joining_date']} - ${exp['leaving_date'] ?? 'present'}`
//             el.querySelector(".exp-desc").innerHTML = exp['description']
//             expList.appendChild(el);
//         }
//     }

//     const skills = req['data']['skills']
//     if(skills != null && skills.length > 0) {
//         for (let i = 0; i < skills.length; i++) {
//             const skill = skills[i];
//             skillsList.innerHTML += `<div class="skill">${skill['skill']}</div>`
//         }
//     }
// };

// async function GetUser(id) {
//     let formData = new FormData();
//     formData.append('Authorization', `Bearer ${userToken}`)
//     formData.append('id', id)
//     const response = await fetch(API + 'user', {
//         credentials: "same-origin",
//         method: "POST",
//         body: formData
//     })
//     return response.json()
// }