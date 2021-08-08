// eslint-disable-next-line no-use-before-define
if (!API_HOST) {
  var API_HOST;
  if (process.env.NODE_ENV === "development") {
    API_HOST = "http://127.0.0.1:5000";
  } else if (process.env.NODE_ENV === "production") {
    API_HOST = "https://stackoverflow.com/";
  }
}

export default API_HOST;
