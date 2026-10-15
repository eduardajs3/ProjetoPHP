import userAvatar from '../assets/user.png';

export function MeetingsTable({ data }) {
  return (
    <div className="overflow-x-auto w-full bg-white rounded-lg">
      {data && data.length >= 1 ? (
        <table className="relative w-full table-auto border-collapse">
          <div className="h-3 w-full bg-background absolute"></div>
          <thead className="w-full rounded-lg bg-white">
            <tr>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Evento</th>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Data</th>
              <th className="text-text text-xs font-normal h-12 px-4 leading-[48px] truncate h-12 text-ellipsis text-left">Participantes</th>
            </tr>
          </thead>
          <br />
          <tbody className="w-full bg-white">
            {data.map(row => {
              return (
                <tr key={row.id} className="w-full border-b border-box">
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    {row.event.name}
                  </td>
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    {Intl.DateTimeFormat('pt-BR', {
                      dateStyle: 'full'
                    }).format(new Date(row.created_at))}
                  </td>
                  <td className="text-xs h-12 px-4 leading-[48px] text-text truncate h-12 text-ellipsis">
                    <div className="flex flex-row">
                      {row.attendees.map(attendee => {
                        return (
                          <div key={attendee.id} className="size-8 mx-[-6px] relative">
                            <img src={attendee.avatar ? attendee.avatar : userAvatar} alt="Avatar" className="size-8" />
                          </div>
                        );
                      })}
                    </div>
                  </td>
                </tr>
              );
            })}
          </tbody>
        </table>
      ) : (
        <div className="text-text leading-[48px] text-center">Nenhuma reunião cadastrada</div>
      )}
      <div className="w-full bg-white h-12 rounded-tfoot"></div>
    </div>
  );
}