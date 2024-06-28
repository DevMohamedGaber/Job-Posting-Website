const profileMenu = document.getElementById("profileMenu")
const navbar = document.getElementById("Navbar")
const PostsList = document.getElementById("PostsList")
const applyModal = document.getElementById('applyModal');
const popup = document.getElementById("popup");
const postTemplate = PostsList.children[0]

var userToken = window.localStorage.getItem("userToken")
var selectedJob = null

function toggleMenu() {
    var menu = document.getElementById("navbarMenu");
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
}
function SwitchOnline() {
    navbar.classList.toggle('online')
}
function redirectToPage(from, to = "index.html") {
    window.location.href = window.location.href.replace(from, to)
}
function toggleDetails(num) {
    const details = PostsList.querySelector('#job-details-' + num);
    details.style.display = details.style.display === 'none' || details.style.display === '' ? 'block' : 'none';
}
function toggleComments(parent) {
    const commentsContainer = parent.querySelector('#comments-container');
    commentsContainer.style.display = commentsContainer.style.display === 'none' || commentsContainer.style.display === '' ? 'block' : 'none';
}
async function SubmitCurrentJobRequest() {
    let res = await AddApply()
    applyModal.querySelector('.msg').innerHTML = res['data']
}
function OpenModal(id) {
    selectedJob = id
    applyModal.style.display = 'block';
}

function closeModal() {
applyModal.style.display = 'none';
}

window.onclick = function (event) {
if (event.target == applyModal) {
    applyModal.style.display = 'none';
}
};
// calls
async function AddApply() {
    let formData = new FormData();
    formData.append('Authorization', `Bearer ${userToken}`)
    formData.append('post_id', selectedJob)
    const response = await fetch(API + 'post/apply', {
        credentials: "same-origin",
        method: "POST",
        body: formData
    })
    return response.json()
}

document.addEventListener("DOMContentLoaded", () => {
    const openPopupBtn = document.getElementById("openPopup");
    const closeBtn = document.querySelector(".close");

    openPopupBtn.addEventListener("click", () => {
      popup.style.display = "block";
    });

    closeBtn.addEventListener("click", () => {
        closeCreatePostPopup()
    });

    window.addEventListener("click", (event) => {
      if (event.target === popup) {
        closeCreatePostPopup()
      }
    });
  });

function closeCreatePostPopup() {
    popup.style.display = "none";
}


async function LikePost(e, id) {
    let formData = new FormData()
    formData.append('post_id', id)
    const response = await fetch('/handlers/likePost.php', {
        method: "POST",
        body: formData
    })
    let res = await response.text()
    if(res == "Added") {
        e.target.classList.add('liked')
        return
    }
    e.target.classList.remove('liked')
}
async function ShowComments(id, i) {
    const postEl = PostsList.querySelector('#job-post-' + i)
    const commentsEl = postEl.querySelector('.comments-section')
    toggleComments(postEl)
    const response = await fetch('/handlers/getComments.php?id=' + id, {
        method: "Get"
    })
    const comments = await response.json()
    if(typeof(comments) != "object") {
        return
    }

    for (let i = 0; i < comments.length; i++) {
        const comment = comments[i];
        commentsEl.innerHTML += `
            <div class="comment">
                <img
                    src="https://placehold.co/40x40?text=img"
                    alt="User Avatar"
                    class="comment-avatar"
                />
                <div class="comment-data">
                    <div class="comment-actions">
                    <button class="actions-btn" onclick="showCommentActions()">
                        ...
                    </button>
                    <div class="actions-menu">
                        <p>Edit</p>
                        <p>Delete</p>
                    </div>
                    </div>
                    <p class="comment-user-name">${comment['user_name']}</p>
                    <p class="comment-user-title">${comment['user_title']}</p>
                    <p class="comment-time">${comment['created_at']}</p>
                    <p class="comment-body">${comment['content']}</p>
                </div>
            </div>`
    }
}

async function AddComment(e, id, i) {
    if(e.key !== "Enter") {
        return
    }

    e.preventDefault()

    let formData = new FormData()
    formData.append('id', id)
    formData.append('content', e.target.value)
    const response = await fetch('/handlers/addComment.php', {
        method: "POST",
        body: formData
    })
    if(await response.text() != "Done") {
        return
    }

    const postEl = PostsList.querySelector('#job-post-' + i)
    const commentsEl = postEl.querySelector('.comments-section')
    const date = new Date()
    commentsEl.innerHTML += `
        <div class="comment">
            <img
                src="https://placehold.co/40x40?text=img"
                alt="User Avatar"
                class="comment-avatar"
            />
            <div class="comment-data">
                <div class="comment-actions">
                <button class="actions-btn" onclick="showCommentActions()">
                    ...
                </button>
                <div class="actions-menu">
                    <p>Edit</p>
                    <p>Delete</p>
                </div>
                </div>
                <p class="comment-user-name">${user['fists_name'] + " " + user['fists_name']}</p>
                <p class="comment-user-title">${user['title']}</p>
                <p class="comment-time">${date}</p>
                <p class="comment-body">${e.target.value}</p>
            </div>
        </div>`

    e.target.value = ''
}
async function AddPost(e) {
    e.preventDefault()
    
    let formData = new FormData(e.target);
    const response = await fetch('/handlers/addPost.php', {
        method: "POST",
        body: formData
    })
    let res = await response.json()

    if(typeof(res) != "object") {
        console.log(await response.text())
        return
    }

    ShowPost(res)
    e.target.reset()
    closeCreatePostPopup()
}

async function Logout() {
    const response = await fetch('/handlers/logout.php', {
        method: "POST",
    })
    let res = await response.text()
    if(res != "Done") {
        console.log('logout failed')
        return
    }
    window.location.href = '/login.php'
}
function ShowPost(post) {
    const el = postTemplate.cloneNode(true)
        
    el.querySelector(".postPosition").innerHTML = post['position']
    el.querySelector(".company").innerHTML = `${post['company']} <span class="location">- ${post['location']}</span>`
    el.querySelector(".posted").innerHTML = `posted ${post['created_at']}`
    el.querySelector(".salary-value").innerHTML = post['salary'] != 0 ? post['salary'] + '$' : 'Confidential'
    el.querySelector(".industry-value").innerHTML = post['industry']
    el.querySelector(".description").innerHTML = post['description']
    el.querySelector(".apply-btn").addEventListener('click', (e) => {
        OpenModal(post['id'])
    })
    el.querySelector(".apply-btn").addEventListener('click', (e) => {
        OpenModal(post['id'])
    })
    el.querySelector(".details-btn").addEventListener('click', (e) => {
        toggleDetails(el)
    })
    el.querySelector(".comments-show").addEventListener('click', async (e) => {
        toggleComments(el)
        await ShowComments(post, el)
    })
    var postId = post.id
    el.querySelector('#addCommentInput').addEventListener("keypress", async function(event) {
        if (event.key === "Enter") {
            event.preventDefault()
            const content = event.target.value
            console.log(postId);
            let comment = await SendComment(post.id, content)
            AddComment(el.querySelector('.comments-section'), comment['data'])
        }
        })
    PostsList.appendChild(el);
}