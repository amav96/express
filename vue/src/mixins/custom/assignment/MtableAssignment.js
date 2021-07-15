var tableAssignment = {
    computed: {
        disabledAutomaticBtn() {
            if (this.resources.sectionCurrent === 'user') { return true; } else { return false; }
        }
    },
    data() {
        return {
            select: {
                selected: [],
            },
            id_user: '',
            dateRange: '',
            btnDisabled: false,

        }
    },
    methods: {
        handle_function_call(function_name) {
            this[function_name]()
        },
        $_selectAll() {
            if (this.select.selected && this.select.selected.length < 1) {
                this.resources.table.dataResponseDB.forEach((val, index) => {
                    if (val.belongs) {
                        this.$refs.check[index].checked = true
                        const value = { id: val.id, id_user: val.belongs.id_user }
                        this.select.selected.push(value)
                    }


                })
            } else {
                this.select.selected = []
                this.$refs.check.forEach((val) => {
                    if (val.checked) val.checked = false
                })
            }

        },
        showSellectAll(data) {
            var assignable = []
            data.forEach((val) => { if (val.belongs) assignable.push(val) })
            if (assignable.length > 0) { return true } else { return false }
        },
        returnValueSelected(id, belongs) {
            const value = {
                id,
                id_user: belongs,
                empty: false
            }
            return value
        },
        returnValueSelectedEmpty(id, belongs) {
            const value = {
                id,
                id_user: belongs,
                empty: true
            }
            return value
        },
        _automaticAssigned() {
            this.btnDisabled = true
            const url = this.resources.url_actions.toAssign
            const dataRequest = {
                value: this.select.selected,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")
                    this.resetCheckbox()
                    this.$nextTick(() => {

                        setTimeout(() => {
                            this.$message('Realizado correctamente', 'success');
                        }, 700);


                    })

                })
                .catch(err => {
                    console.log(err)
                })
        },
        _manualAssigned() {
            this.btnDisabled = true
            const url = this.resources.url_actions.toAssign
            var value = []
            this.select.selected.forEach((val) => {
                value.push({ id: val.id, id_user: this.id_user })
            })

            const dataRequest = {
                value: value,
                dateRange: this.dateRange,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")
                    this.resetCheckbox()
                    this.manualAssignment.display = false
                    setTimeout(() => {
                        this.$message('Realizado correctamente', 'success');
                    }, 700);

                })
                .catch(err => {
                    console.log(err)
                })
        },
        _removeAssigned() {
            this.btnDisabled = true
            const value = this.select.selected.filter(item => !item.empty)

            if (value.length < 1) {
                this.$message('Los registros seleccionados no estan asignados', 'error');
                this.btnDisabled = false
                return
            }

            const url = this.resources.url_actions.removeAssign
            const dataRequest = {
                value: value,
                created_at: this.getDateTime(),
                admin: this.resources.admin
            }
            axios.get(url, { params: { dataRequest } })
                .then(res => {
                    this.btnDisabled = false
                    if (res.data.error) {
                        this.$message('Se ha producido una excepción', 'error');
                        return
                    }
                    this.$emit("realoadCurrentPage")
                    this.resetCheckbox()
                    this.manualAssignment.display = false
                    setTimeout(() => {
                        this.$message('Realizado correctamente', 'success');

                    }, 700);

                })
                .catch(err => {
                    console.log(err)
                })


        },
        $message(msg, color) {
            const snack = { display: true, timeout: 2500, text: msg, color: color }
            this.$emit("setSnack", snack)
        },
        resetCheckbox() {
            this.select.selected = []
            this.$refs.check.forEach((val) => {
                if (val.checked) { val.checked = false }
            })
        },
        getDateTime() {
            var today = new Date();
            var getMin = today.getMinutes();
            var getSeconds = today.getSeconds()
            var getHours = today.getHours()

            if (getMin < 10) { getMin = '0' + today.getMinutes() }
            if (getSeconds < 10) { getSeconds = '0' + today.getSeconds() }
            if (getHours < 10) { getHours = '0' + today.getHours() }

            var created_at = today.getFullYear() + '-' + ("0" + (today.getMonth() + 1)).slice(-2) + '-' +
                ("0" + today.getDate()).slice(-2) + ' ' + getHours + ':' + getMin + ':' + getSeconds;

            return created_at
        },
        $reloadCurrentPage() {
            this.$emit("realoadCurrentPage")
        },
        updatePagination() {
            if (this.select.selected.length < 1 && !this.resources.loadingPaginate.display) {
                this.$emit("reaload", true)
                this.$nextTick(() => {
                    this.$emit("realoadCurrentPage")
                })

            }
        },
        isSelected() {
            setInterval(() => {
                this.updatePagination()
            }, 100000)
        },
        cleanSelected() {
            this.select.selected = []
        },
        $cleanSectionCurrent() {
            this.$emit("cleanSectionCurrent", '')
        }
    },
    created() {
        this.isSelected();
    },
    destroyed() {
        this.$cleanSectionCurrent()
    },
    watch: {
        select: {
            handler(val) {
                this.$emit("setSelected", val.selected)

            },
            deep: true
        }
    },

}