// store/index.js
import { createStore } from 'vuex';

export default createStore({
  state: {
    results: [] // Define results state property
  },
  mutations: {
    // Define mutation to update results state
    setResults(state, results) {
      state.results = results;
    }
  },
  actions: {
    // Define action to store results data
    storeResults({ commit }, results) {
      commit('setResults', results); // Commit the mutation to update results state
    }
  },
  getters: {
    // Getter to access results state property
    results: state => state.results
  }
});
