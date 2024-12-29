import chirrrpMeta from "@/Services/chirrpMetaService";
import localStorage from "../../Utlities/helper";

const state = {
    chirrrpMeta: {},
    professions: {},
    industryID: null,
    professionID: null,
    coworkerReviewID: null,
    team_loveable_aspect_id: null,
    // salaries: [],
    // experiences: [],
    hobbyID: null,
    employerSelectionPreferenceID: null,
    preferWorkLocationID: null,
    recruiters: {},
};

// getters
const getters = {};

// mutations
const mutations = {
    CHIRRRP_META(state, payload) {
        state.chirrrpMeta = payload;
    },
    INDUSTRY_ID(state, payload) {
        state.industryID = payload;
    },
    PROFESSION_ID(state, payload) {
        state.professionID = payload;
    },
    PROFESSIONS(state, payload) {
        state.professions = payload;
    },
    // SALARIES(state, payload) {
    //     state.salaries = payload;
    // },
    COWORKER_REVIEW_ID(state, payload) {
        state.coworkerReviewID = payload;
    },
    PREFER_WORK_LOCATION_ID(state, payload) {
        state.preferWorkLocationID = payload;
    },
    EMPLOYER_SELECTION_PREFERENCE_ID(state, payload) {
        state.employerSelectionPreferenceID = payload;
    },
    HOBBy_ID(state, payload) {
        state.hobbyID = payload;
    },
    TEAM_LOVEABLE_ASPECT(state, payload) {
        state.team_loveable_aspect_id = payload;
    },
    // EXPERIENCES(state, payload) {
    //     state.experiences = payload;
    // },
    SELECTED_ID(state, payload) {
        state.selectedIndustryId = payload.id;
    },
    SELECTED_IDS(state, payload) {
        state.selectedIds = payload;
    },
    RECRUITER(state, payload) {
        state.recruiters = payload;
    },
};
// actions
const actions = {
    async getMetaData({ commit }) {
        let response = await chirrrpMeta.getMetaData();
        if (response.data.data) {
            commit("CHIRRRP_META", response.data.data);
            commit("INDUSTRY_ID", response.data.data.industries[0].id);
            commit("PROFESSION_ID", response.data.data.professions[0].id);
            commit(
                "COWORKER_REVIEW_ID",
                response.data.data.coworkerReviews[0].id
            );
            commit(
                "PREFER_WORK_LOCATION_ID",
                response.data.data.preferWorkLocations[0].id
            );
            commit("HOBBy_ID", response.data.data.hobbies[0].id);
            commit(
                "EMPLOYER_SELECTION_PREFERENCE_ID",
                response.data.data.employerSelectionPreference[0].id
            );
            commit(
                "TEAM_LOVEABLE_ASPECT",
                response.data.data.teamLovableAspects[0].id
            );

            let payload = {
                industryId: response.data.data.industries[0].id,
                profession_id: response.data.data.professions[0].id,
                prefer_work_location_id:
                    response.data.data.preferWorkLocations[0].id,
                employer_selection_preference_id:
                    response.data.data.preferWorkLocations[0].id,
                coworker_review_id: response.data.data.coworkerReviews[0].id,
                hobby_id: response.data.data.hobbies[0].id,
                team_loveable_aspect_id:
                    response.data.data.teamLovableAspects[0].id,
                management_style_id: [
                    response.data.data.ManagementStyles[0].id,
                ],
            };
            let formData = localStorage.getLocalStorage("mutlistepfm");
            console.log(formData.industryId);

            if (formData.industryId == undefined) {
                localStorage.setLocalStorage("mutlistepfm", payload);
            }
            // commit("SELECTED_IDS", {
            //     coworkerReviewId: response.data.data.coworkerReviews[0].id,
            // });
        }
        return response.data.data;
    },
    async getProfessions({ commit }, payload) {
        let response = await chirrrpMeta.getProfessions(payload);
        if (response.data.data) {
            commit("PROFESSIONS", response.data.data);
            commit("PROFESSION_ID", response.data.data.professions);
        }
        return response.data.data;
    },

    async getRecruiters({ commit }) {
        let response = await chirrrpMeta.getRecruiters();
        if (response.data.data) {
            commit("RECRUITER", response.data.data);
        }
        return response.data.data;
    },
};
export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
