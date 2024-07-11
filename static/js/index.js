const PostsList = document.getElementById("PostsList")
const applyModal = document.getElementById('applyModal');
const popup = document.getElementById("popup");
var selectedJob = null

/* hock */
window.onclick = function (event) {
    if (event.target == applyModal) {
        applyModal.style.display = 'none';
    }
    if (event.target === popup) {
        closeCreatePostPopup()
    }
};
/* toggles */
function toggleMenu() {
    var menu = document.getElementById("navbarMenu");
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
}
function toggleDetails(num) {
    const details = PostsList.querySelector('#job-details-' + num);
    details.style.display = details.style.display === 'none' || details.style.display === '' ? 'block' : 'none';
}
function toggleComments(parent) {
    const commentsContainer = parent.querySelector('#comments-container');
    commentsContainer.style.display = commentsContainer.style.display === 'none' || commentsContainer.style.display === '' ? 'block' : 'none';
}
/* Modal functions */
function OpenModal(id) {
    selectedJob = id
    applyModal.style.display = 'block'
}
function closeModal() {
    selectedJob = null
    applyModal.style.display = 'none'
}

/* popup fuctions */
function closeCreatePostPopup() {
    popup.style.display = "none";
}
function openCreatePostPopup() {
    popup.style.display = "block";
}

/* api calls */
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
                <p class="comment-user-name">${user['first_name'] + " " + user['last_name']}</p>
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
async function Apply(e) {
    e.preventDefault()

    let formData = new FormData(e.target)
    formData.append('id', selectedJob)
    const response = await fetch('/handlers/apply.php', {
        method: "POST",
        body: formData
    })
    let res = await response.text()

    if(res != "Done") {
        applyModal.querySelector('.msg').innerHTML = res
        return
    }
    e.target.reset()
    closeModal();
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

/* helpers */
function ShowPost(post) {n
    let num = PostsList.children.length
    PostsList.innerHTML += `
        <div class="job-listing" id="job-post-${num}">
            <div class="job-header">
            <div class="job-header-data">
                <h2 class="postPosition">${post['position']}</h2>
                <p class="company">
                Company Name
                <span class="location">- ${post['location']}</span>
                </p>
                <p class="posted">${post['created_at']}</p>
                <p class="applicants-num">0 Applicants</p>
                <div class="buttons">
                <button class="apply-btn" onclick="OpenModal(${post['id']})">Apply For Job</button>
                <button class="details-btn" onclick="toggleDetails(${num})">Show Details</button>
                </div>
            </div>
            <div class="job-header-img"></div>
        </div>
      
        <div class="job-details" id="job-details-${num}">
            <div class="job-info">
            <div>
                <h3>Salary</h3>
                <p class="salary-value">${post['salary']}</p>
            </div>
            <div>
                <h3>Industry</h3>
                <p class="industry-value">${post['industry']}</p>
            </div>
            <div>
                <h3>Job Description</h3>
                <p class="description">${post['description']}</p>
            </div>
            </div>
        </div>
      
        <!-- start interaction-section -->
    
        <div class="interaction-section">
            <div class="interaction-header">
            <div class="likes-count">
                <span>👍 0 Likes</span>
            </div>
            <div class="comments-count">
                <span>0 comments</span>
            </div>
            </div>
            <div class="interaction-buttons">
            <span  onclick="LikePost(event, ${post['id']})">Like</span>
            <span class="comments-show" onclick="ShowComments(${post['id']}, ${num})">Comments</span>
            </div>
    
            <!-- strat toggleable comments section -->
    
            <div id="comments-container" style="display: none">
            <div class="add-comment">
                <img
                src="https://placehold.co/40x40?text=img"
                alt="User Avatar"
                class="user-avatar"
                />
                <input
                id="addCommentInput"
                type="text"
                placeholder="Add a comment..."
                class="comment-input"
                onkeypress="return AddComment(event, ${post['id']}, ${num})"
                />
            </div>
            <div class="comments-section"></div>
            </div>
        </div>`
}
