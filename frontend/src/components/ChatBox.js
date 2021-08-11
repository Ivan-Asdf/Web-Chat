import { createRef, useEffect } from "react";
import ChatEntry from "./ChatEntry";

export default function ChatBox({ chatEntries }) {
  const endDummy = createRef();
  useEffect(() =>
    endDummy.current.scrollIntoView({ block: "end", behavior: "smooth" })
  );

  return (
    <div className="chatbox">
      {chatEntries
        ? chatEntries.map((chatEntry) => (
            <ChatEntry
              id={chatEntry.id}
              user_id={chatEntry.user_id}
              username={chatEntry.username}
              content={chatEntry.content}
              key={chatEntry.id}
            />
          ))
        : ""}
      <div className="dummy" ref={endDummy}></div>
    </div>
  );
}
