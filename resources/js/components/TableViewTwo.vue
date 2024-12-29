<template>
  <div class="table__box">
    <table class="member__table talent__member--table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Employer ID</th>
          <th>Email</th>
          <th>Recommend By</th>
          <th>Last Login</th>
          <th style="text-align: center">Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="member__info d__flex premium__user">
              <div class="member__img">
                <img src="../../images/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status active__member">
              <span>Active</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="member__info d__flex normal__user">
              <div class="member__img">
                <img src="../assets/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status pending__member">
              <span>Pending</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="member__info d__flex premium__user">
              <div class="member__img">
                <img src="../assets/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status deactived__member">
              <span>deactived</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="member__info d__flex premium__user">
              <div class="member__img">
                <img src="../assets/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status active__member">
              <span>Active</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="member__info d__flex normal__user">
              <div class="member__img">
                <img src="../assets/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status active__member">
              <span>Active</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <div class="member__info d__flex normal__user">
              <div class="member__img">
                <img src="../assets/img/user-1.png" alt="" />
              </div>
              <div class="member__name">
                <h4>Eyem McLovin</h4>
                <h5>Super Admin</h5>
              </div>
            </div>
          </td>
          <td>C- 1000212</td>
          <td>Albertmichael@mail.com</td>
          <td>claud alexamder</td>
          <td>3 days ago</td>
          <td>
            <div class="member__status active__member">
              <span>Active</span>
            </div>
          </td>
          <td>
            <button class="member__delete">
              <svg
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M10.3333 2.99992H13.6666V4.33325H12.3333V12.9999C12.3333 13.1767 12.263 13.3463 12.138 13.4713C12.013 13.5963 11.8434 13.6666 11.6666 13.6666H2.33325C2.15644 13.6666 1.98687 13.5963 1.86185 13.4713C1.73682 13.3463 1.66659 13.1767 1.66659 12.9999V4.33325H0.333252V2.99992H3.66659V0.999919C3.66659 0.823108 3.73682 0.653538 3.86185 0.528514C3.98687 0.40349 4.15644 0.333252 4.33325 0.333252H9.66659C9.8434 0.333252 10.013 0.40349 10.138 0.528514C10.263 0.653538 10.3333 0.823108 10.3333 0.999919V2.99992ZM10.9999 4.33325H2.99992V12.3333H10.9999V4.33325ZM4.99992 6.33325H6.33325V10.3333H4.99992V6.33325ZM7.66659 6.33325H8.99992V10.3333H7.66659V6.33325ZM4.99992 1.66659V2.99992H8.99992V1.66659H4.99992Z"
                  fill="#91A4B7"
                />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "TableViewTwo",
};
</script>

<style lang="scss" scoped></style>
