
import AppLayout from "@/layouts/app-layout";
import { useTable } from "react-table";

export default function Users({ users }) {
    // Table columns definition
    const columns = React.useMemo(
        () => [
            { Header: "ID", accessor: "id" },
            { Header: "Name", accessor: "name" },
            { Header: "Email", accessor: "email" },
            { Header: "Mobile", accessor: "mobile_number" },
        ],
        []
    );

    // Table data (comes from Laravel controller)
    const data = React.useMemo(() => users, [users]);

    // Table instance
    const { getTableProps, getTableBodyProps, headerGroups, rows, prepareRow } =
        useTable({ columns, data });

    return (
        <AppLayout>
            <h1 className="text-2xl font-bold mb-4">Employees</h1>
            <table
                {...getTableProps()}
                className="table-auto border-collapse border border-gray-300 w-full"
            >
                <thead className="bg-gray-100">
                    {headerGroups.map((headerGroup) => (
                        <tr {...headerGroup.getHeaderGroupProps()}>
                            {headerGroup.headers.map((column) => (
                                <th
                                    {...column.getHeaderProps()}
                                    className="border border-gray-300 px-4 py-2 text-left"
                                >
                                    {column.render("Header")}
                                </th>
                            ))}
                        </tr>
                    ))}
                </thead>
                <tbody {...getTableBodyProps()}>
                    {rows.map((row) => {
                        prepareRow(row);
                        return (
                            <tr {...row.getRowProps()}>
                                {row.cells.map((cell) => (
                                    <td
                                        {...cell.getCellProps()}
                                        className="border border-gray-300 px-4 py-2"
                                    >
                                        {cell.render("Cell")}
                                    </td>
                                ))}
                            </tr>
                        );
                    })}
                </tbody>
            </table>
        </AppLayout>
    );
}
