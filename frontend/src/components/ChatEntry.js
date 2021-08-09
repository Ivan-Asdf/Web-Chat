export default function ChatEntry({ id, user_id, content }) {
  // console.log(id, user_id, content)
  return (
    <div className="chatentry" id={id}>
      <img src="frog.jpg" alt="user_avatar" />
      <p className="username">
        <b>{user_id}</b>
      </p>
      <p className="message">{content}</p>
    </div>
  );
}
