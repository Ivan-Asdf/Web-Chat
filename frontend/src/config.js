// eslint-disable-next-line no-use-before-define
if (!API_HOST) {
  var API_HOST;
  if (process.env.NODE_ENV === "development") {
    API_HOST = process.env.REACT_APP_API_HOST_DEV;
  } else if (process.env.NODE_ENV === "production") {
    API_HOST = process.env.REACT_APP_API_HOST_PROD;
  }
}

export default API_HOST;
