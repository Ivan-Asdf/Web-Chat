import ChatEntry from "./ChatEntry";

export default function ChatBox({ chatEntries }) {
  console.log("ChatBox", chatEntries);
  return (
    <div className="chatbox">
      {chatEntries ? (chatEntries.map((chatEntry) => (
        <ChatEntry id={chatEntry.id} user_id={chatEntry.user_id} content={chatEntry.content} key={chatEntry.id} />
      ))) : ""}
    </div>
  );
}
