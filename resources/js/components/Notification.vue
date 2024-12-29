<template>
    <div class="site__header-notification">
        <div
            class="notification__icon new"
            v-click-outside="hide"
            @click="toggle"
        >
            <svg
                width="16"
                height="20"
                viewBox="0 0 16 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M8 20C9.1 20 10 19.1 10 18H6C6 19.1 6.9 20 8 20ZM14 14V9C14 5.93 12.37 3.36 9.5 2.68V2C9.5 1.17 8.83 0.5 8 0.5C7.17 0.5 6.5 1.17 6.5 2V2.68C3.64 3.36 2 5.92 2 9V14L0 16V17H16V16L14 14ZM12 15H4V9C4 6.52 5.51 4.5 8 4.5C10.49 4.5 12 6.52 12 9V15Z"
                    fill="#3A3541"
                    fill-opacity="0.87"
                />
            </svg>
        </div>
        <div
            class="notification__dropdown show"
            v-show="isShowNotification"
            ref="notification__dropdown"
        >
            <div class="notification__dropdown-head">
                <h5>Notifications</h5>
                <span
                    v-if="notifications?.length > 0"
                    @click="markAllAsRead"
                    class="d__flex d__flex-v-center"
                >
                    Mark all as read
                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 16 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M14 8C14 4.6875 11.3125 2 8 2C4.6875 2 2 4.6875 2 8C2 11.3125 4.6875 14 8 14C11.3125 14 14 11.3125 14 8Z"
                            stroke="#3D70E0"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                        />
                        <path
                            d="M11 5.5L6.8 10.5L5 8.5"
                            stroke="#3D70E0"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </div>
            <ul
                v-if="notifications?.length > 0"
                class="notification__dropdown-body"
            >
                <li
                    class="ndb__single-notification"
                    v-for="notification in this.notifications"
                    :key="notification"
                >
                    <!-- v-model="notification.id"
                                :value="notification.id" -->
                    <div class="ndb__check">
                        <label for="" class="matches__content-box-check">
                            <input
                                type="checkbox"
                                @click="check(notification?.id)"
                            />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="ndb__content d__flex">
                        <img src="../assets/img/user-1.png" alt="" />
                        <div class="ndb__content-inner">
                            <p>
                                <b>{{
                                    notification?.sender?.first_name +
                                    " " +
                                    notification?.sender?.last_name +
                                    " "
                                }}</b>
                                {{ notification?.content }}

                                <b v-if="notification?.position?.company"
                                    >{{
                                        notification?.position?.company
                                            ?.first_name +
                                        " " +
                                        notification?.position?.company
                                            ?.last_name +
                                        " "
                                    }}
                                </b>
                                <text v-if="notification?.position?.company">
                                    for position
                                </text>
                                <b v-if="notification?.position?.company"
                                    >{{
                                        " " +
                                        notification?.position?.profession?.name
                                    }}
                                </b>
                                <!-- {{
                                at
                                    " " +
                                    notification.company_user_match
                                        .interview_start_date_time
                                }} -->
                            </p>
                            <span>{{ notification?.created_at }}</span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul v-else>
                <li><h4>No notification found</h4></li>
            </ul>
            <div
                v-if="notifications?.length > 0"
                class="notification__dropdown-foot"
            >
                <span @click="markAsRead">
                    <svg
                        width="12"
                        height="12"
                        viewBox="0 0 12 12"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M14 8C14 4.6875 11.3125 2 8 2C4.6875 2 2 4.6875 2 8C2 11.3125 4.6875 14 8 14C11.3125 14 14 11.3125 14 8Z"
                            stroke="#3D70E0"
                            stroke-width="1.5"
                            stroke-miterlimit="10"
                        />
                        <path
                            d="M11 5.5L6.8 10.5L5 8.5"
                            stroke="#3D70E0"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                    Mark as Read
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import notificationService from "../Services/notificationService";
export default {
    name: "Notification",
    data() {
        return {
            notifications: [],
            isShowNotification: false,
            notification_id: [],
            date: "",
            count: 0,
        };
    },
    created() {
        this.closeModal();
        this.getNotification();
    },
    methods: {
        closeModal() {
            window.addEventListener("click", (e) => {
                if (!this.$el.contains(e.target)) {
                    this.isShowNotification = false;
                }
            });
        },
        toggle() {
            this.isShowNotification =
                this.isShowNotification == false ? true : false;
            if (this.isShowNotification) {
                this.getNotification();
            }
        },

        hide() {
            this.isShowNotification = false;
        },

        getNotification() {
            notificationService
                .getNotification()
                .then((data) => {
                    this.notifications = data.data.data;
                })
                .catch((error) => {
                    this.$toast.error(error.data.message);
                });
        },
        markAllAsRead() {
            notificationService
                .markAllAsRead()
                .then((data) => {
                    console.log("mark all read:", data.data.message);
                    this.$toast.success("Marked all as read");
                    this.getNotification();
                })
                .catch((error) => {
                    this.$toast.error(error.data.message);
                });
        },
        check(id) {
            if (this.notification_id.includes(id)) {
                this.notification_id.splice(
                    this.notification_id.indexOf(id),
                    1
                );
            } else {
                this.notification_id.push(id);
            }
        },
        markAsRead() {
            notificationService
                .markAsRead({ notification_id: this.notification_id })
                .then((data) => {
                    console.log("mark read:", data.data.message);
                    this.$toast.success("Marked as read");
                    this.getNotification();
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },
    },
};
</script>

<style scoped>
.close {
    display: none;
}
</style>
