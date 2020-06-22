//addBooks Modal
const addBooksContainer = document.querySelector(".addBooksContainer");

const addBooks = () => {
  addBooksContainer.classList.remove("closeModal");
};

const addBooksModalClose = () => {
  addBooksContainer.classList.add("closeModal");
};

//addMembers Modal
const addMembersContainer = document.querySelector(".addMembersContainer");

const addMembers = () => {
  addMembersContainer.classList.remove("closeModal");
};

const addMembersModalClose = () => {
  addMembersContainer.classList.add("closeModal");
};

//issueBooks Modal
const issueBooksContainer = document.querySelector(".issueBooksContainer");

const issueBooks = () => {
  issueBooksContainer.classList.remove("closeModal");
};

const issueBooksModalClose = () => {
  issueBooksContainer.classList.add("closeModal");
};
