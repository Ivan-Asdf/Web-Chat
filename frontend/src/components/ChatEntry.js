import API_HOST from "../config";

export default function ChatEntry({ id, user_id, content, username }) {
  const avatarUrl = API_HOST + "/user_avatar.php?user_id=" + user_id;
  return (
    <div className="chatentry" id={id}>
      <img src={avatarUrl} alt="user_avatar" />
      <p className="username">
        <b>{username}</b>
      </p>
      <p className="message">{content}</p>
    </div>
  );
}
