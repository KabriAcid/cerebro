function sendAjaxRequest(url, method, data, callback, errorCallback = null) {
  const xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Set a timeout for the request (e.g., 10 seconds)
  xhr.timeout = 10000;

  // Handle the response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status >= 200 && xhr.status < 300) {
        try {
          const response = JSON.parse(xhr.responseText);
          callback(response);
        } catch (e) {
          if (errorCallback) {
            errorCallback({ error: "Invalid JSON response", details: e });
          } else {
            console.error("Invalid JSON response:", e);
          }
        }
      } else {
        if (errorCallback) {
          errorCallback({
            error: `HTTP error: ${xhr.status}`,
            status: xhr.status,
          });
        } else {
          console.error(`HTTP error: ${xhr.status}`);
        }
      }
    }
  };

  // Handle network errors
  xhr.onerror = function () {
    if (errorCallback) {
      errorCallback({ error: "Network error" });
    } else {
      console.error("Network error");
    }
  };

  // Handle timeout
  xhr.ontimeout = function () {
    if (errorCallback) {
      errorCallback({ error: "Request timed out" });
    } else {
      console.error("Request timed out");
    }
  };

  // Send the request
  try {
    xhr.send(JSON.stringify(data));
  } catch (e) {
    if (errorCallback) {
      errorCallback({ error: "Failed to send request", details: e });
    } else {
      console.error("Failed to send request:", e);
    }
  }
}
